import * as _ from '../../utils/lodash';
import * as rx from '../../utils/rx';
import { observeComponentLifecycles } from '../../utils/observe-component-lifecycles';
import { useStreams } from '../../utils/use-streams';
import template from './assets-background.component.html';
import { observeCompChange } from '../../utils/observe-comp-change';
import { tapLog } from '../../utils/tap-log';

const iconsMap = {
    stock: 6,
    currency: 6,
    crypto: 6,
    index: 5,
    commodity: 4,
};

for (let i = 0; i < iconsMap[this.iconsetName]; i++) {
    const icon = `${this.iconSet}_${i}`;
}

function generateHslColor(hue, saturation, lightness) {
    const hueDelta = hue - 5 + Math.floor(Math.random() * 5);
    const saturationDelta = saturation - 2 + Math.floor(Math.random() * 4);
    const LightnessDelta = lightness + Math.floor(Math.random() * 56);

    return {
        backgroundColor: `hsl(${hueDelta},${saturationDelta}%,${LightnessDelta}%)`,
        lightness: LightnessDelta,
    };
}

function generateBoxShadow(inset, randDistance, minDistance, alpha) {
    const insetSet = inset === 1 ? 'inset' : '';
    return `${insetSet} 0 0 ${Math.floor(Math.random() * randDistance) + minDistance}px rgba(0, 0, 0, ${alpha})`; // prettier-ignore
}

/**
 * Calc sum of cols/squares in each row in the background
 * start with calc of one col responsiveness related to window width by Linear equation
 * example:
 * colWidth in 300px screen width is 30px
 * colWidth in 1910px screen width is 64x
 * coefficient = yDelta = 64 - 30 / xDelta = 1910 - 300 *
 *
 * @param windowWidth
 * @param colDefaultWidth
 * @param colMinWidth
 * @returns {number}
 */
function calcColsCount(windowWidth, colDefaultWidth, colMinWidth) {
    const yDelta = colDefaultWidth - colMinWidth;
    const xDelta = 1910 - 300;
    const coefficient = yDelta / xDelta;
    const relatedColWidth = colMinWidth + coefficient * (windowWidth - 300);
    const num = windowWidth / relatedColWidth;
    return Math.floor(num);
}

/**
 * Calc sum of cols/squares in all rows in the background by:
 * 1. cols count multiple by rows count
 * 2. subtract extra cols in square that contain title
 *
 * @param colsCount
 * @param rowsCount
 * @param extraTitleWidth
 * @returns {number}
 */
function calcSquaresCount(colsCount, rowsCount, extraTitleWidth) {
    return colsCount * rowsCount;
}

/**
 * Calc col/square accurate (not float) width
 * return represent 1em in background inner class
 * as a css var:
 * --squareLength: {{ ($ctrl.squareLength$ | async:this) }};
 *
 * @param wrapperWidth
 * @param ColsCount
 * @returns {number}
 */
function calcSquareLength(wrapperWidth, ColsCount) {
    return Math.ceil(wrapperWidth / ColsCount);
}

/**
 * Calc title position in the second row by:
 * 1. get squares count in a container width to containerCols
 * 2. divided all row cols - containerCols by 2 (left and right to get only start)
 * 3. add first row to the result to get position in second row
 *
 * @param containerWith
 * @param squareLength
 * @param cols
 * @returns {number}
 */
function calcTitlePosition(containerWith, squareLength, cols) {
    const containerCols = containerWith / squareLength;
    return Math.ceil((cols - containerCols) / 2 + cols);
}

/**
 *
 * @param baseBackgroundColor
 * @param shadowParams
 * @returns {{boxShadow: *, backgroundColor: *, lightness: *}}
 */
function drawSquare(baseBackgroundColor, shadowParams) {
    const { backgroundColor, lightness } = generateHslColor(...baseBackgroundColor);

    return {
        backgroundColor,
        lightness,
        boxShadow: generateBoxShadow(...shadowParams),
        timeChanged: Date.now(),
    };
}

/**
 *
 * @param counter
 * @param baseBackgroundColor
 * @returns {[]}
 */
function drawSquares(counter, baseBackgroundColor) {
    const tempSquares = [];

    let insetParam = 0;
    for (let i = 0; i < counter; i++) {
        if (i % 12 === 0) {
            insetParam = 1;
        }
        const shadowParams = [insetParam, 2, 2, 0.05];
        tempSquares.push(drawSquare(baseBackgroundColor, shadowParams));
    }

    return tempSquares;
}

/**
 *
 * @param squareIndex
 * @param backgroundColor
 * @param titleClass
 * @param pageTitle
 * @param squares
 * @returns {...*[]}
 */
function appendTitle(squareIndex, backgroundColor, titleClass, pageTitle, squares) {
    const newSquareTitleData = {
        text: pageTitle,
        backgroundColor,
        titleClass,
    };

    const newSquare = {
        ...squares[squareIndex],
        ...newSquareTitleData,
    };

    const newSquares = [...squares];
    newSquares[squareIndex] = newSquare;

    for (let i = 0; i < 3; i++) {
        const rIndex = i + squareIndex + 1;
        newSquares[rIndex] = {
            ...newSquares[rIndex],
            isAfterTitle: true,
        };
    }

    return newSquares;
}

/**
 *
 * @param width
 * @param squareDefaultLength
 * @param squareMinWidth
 * @param rows
 * @param containerWidth
 * @param baseBackgroundColor
 * @param pageTitle
 * @returns {{squares: *, cols: *, squareLength: *}}
 */
function calcSquares(width, squareDefaultLength, squareMinWidth, rows, containerWidth, baseBackgroundColor, pageTitle) {
    /* eslint-disable-next-line */
    //debugger;
    const cols = calcColsCount(width, squareDefaultLength, squareMinWidth);
    const squaresCount = calcSquaresCount(cols, rows, 3);
    const squareLength = calcSquareLength(width, cols);
    const titleIndex = calcTitlePosition(containerWidth, squareLength, cols);
    const squares = drawSquares(squaresCount, baseBackgroundColor);
    const squaresWithTitle = appendTitle(titleIndex, '#fff', 'prf-assets-background__title', pageTitle, squares);

    return {
        squares: squaresWithTitle,
        cols,
        squareLength,
        squaresCount,
        titleIndex,
    };
}

function reDrawSquare(squareIndex, lightness, backgroundColor, boxShadow, z, squares) {
    const newSquareData = {
        backgroundColor,
        lightness,
        boxShadow,
        timeChanged: Date.now(),
        zIndex: z % 5 === 0 ? 5 : z % 5,
    };

    const newSquares = [...squares];

    newSquares[squareIndex] = {
        ...squares[squareIndex],
        ...newSquareData,
    };

    return newSquares;
}

function reDrawSquareWithIcon(squareIndex, iconName, squares) {
    const newSquareData = {
        icon: iconName,
        boxShadow: generateBoxShadow(0, 20, 20, 0.6),
        zIndex: 8,
    };

    if (squares[squareIndex].lightness < 65) {
        newSquareData.color = '#fff';
    }

    const newSquares = [...squares];

    newSquares[squareIndex] = {
        ...squares[squareIndex],
        ...newSquareData,
    };

    return newSquares;
}

class Controller {
    constructor($element, $timeout) {
        this.$element = $element;
        this.$timeout = $timeout;
        this.lifecycles = observeComponentLifecycles(this);

        this.baseBackgroundColor = [165, 71, 43];

        this.containerId = 'assetsBackgroundContainer';
        this.pageTitleClass = '';
        this.squareDefaultLength$ = new rx.BehaviorSubject(0);
        this.squareMinWidth$ = new rx.BehaviorSubject(0);
        this.rows$ = new rx.BehaviorSubject(0);
        this.squares$ = new rx.BehaviorSubject([]);
        this.pageTitle$ = new rx.BehaviorSubject('');
        this.cols$ = new rx.BehaviorSubject(0);
        this.squareLength$ = new rx.BehaviorSubject(0);
        this.squaresCount$ = new rx.BehaviorSubject(0);
        this.iconSetName$ = new rx.BehaviorSubject('forex');
        this.titleIndex$ = new rx.BehaviorSubject(0);

        useStreams(
            [
                observeCompChange(this.squareDefaultLength$, 'squareDefaultLength', this.lifecycles.onChanges$),
                observeCompChange(this.squareMinWidth$, 'squareMinWidth', this.lifecycles.onChanges$),
                observeCompChange(this.pageTitle$, 'pageTitle', this.lifecycles.onChanges$),
                observeCompChange(this.rows$, 'rows', this.lifecycles.onChanges$),
                observeCompChange(this.iconSetName$, 'iconSetName', this.lifecycles.onChanges$),
                this.streamCalcSquares(),
                this.streamAnimateSquares(),
                this.streamCalcSquaresWithIconSet(),
            ],
            this.lifecycles.onDestroy$
        );
    }

    $onInit() {}

    $onChanges() {}

    $onDestroy() {}

    streamCalcSquares() {
        /* eslint-disable-next-line */
        return rx.pipe(
            () =>
                new rx.Observable(subscriber => {
                    this.$timeout(() => {
                        subscriber.next();
                        subscriber.complete();
                    }, 1000);
                }),
            rx.switchMap(() => {
                return rx.obs.combineLatest(
                    rx.obs.fromEvent(window, 'resize').pipe(
                        rx.debounceTime(200),
                        rx.startWith(1),
                        rx.map(() => ({
                            elementWidth: _.defaultTo(1, this.$element.width()),
                            /* global angular */
                            containerWidth: _.defaultTo(
                                1,
                                angular.element(document.getElementById(this.containerId)).width()
                            ),
                        }))
                    ),
                    this.squareDefaultLength$,
                    this.squareMinWidth$,
                    this.rows$,
                    this.pageTitle$
                );
            }),
            rx.map(([{ elementWidth, containerWidth }, squareDefaultLength, squareMinWidth, rows, pageTitle]) => {
                return calcSquares(
                    elementWidth,
                    squareDefaultLength,
                    squareMinWidth,
                    rows,
                    containerWidth,
                    this.baseBackgroundColor,
                    pageTitle
                );
            }),
            rx.tap(({ squares, cols, squareLength, squaresCount, titleIndex }) => {
                this.squares$.next(squares);
                this.cols$.next(cols);
                this.squareLength$.next(squareLength);
                this.squaresCount$.next(squaresCount);
                this.titleIndex$.next(titleIndex);
            })
        )(null);
    }

    streamAnimateSquares() {
        return rx.pipe(
            () => rx.obs.timer(1000, 400),
            rx.withLatestFrom(this.squaresCount$),
            rx.map(([timeCount, squaresCount]) => ({
                timeCount,
                squareIndex: Math.floor(Math.random() * (squaresCount / 3)) * 3,
            })),
            rx.withLatestFrom(this.squares$),
            rx.filter(([{ timeCount, squareIndex }, squares]) => !squares[squareIndex].text),
            rx.filter(([{ timeCount, squareIndex }, squares]) => !squares[squareIndex].isAfterTitle),
            rx.filter(([{ timeCount, squareIndex }, squares]) => squares[squareIndex].timeChanged <= Date.now() - 800),
            rx.filter(([{ timeCount, squareIndex }, squares]) => !squares[squareIndex].icon),
            rx.filter(([{ timeCount, squareIndex }, squares]) => squareIndex !== 0),
            rx.map(([{ timeCount, squareIndex }, squares]) => {
                const boxShadowParams = squareIndex % 9 === 0 ? [1, 15, 2, 0.2] : [0, 60, 5, 0.5];

                const { backgroundColor, lightness } = generateHslColor(165, 71, 43);
                const boxShadow = generateBoxShadow(...boxShadowParams);
                const newSquares = reDrawSquare(squareIndex, lightness, backgroundColor, boxShadow, timeCount, squares);
                return newSquares;
            }),
            rx.tap(squares => this.squares$.next(squares))
        )(null);
    }

    streamCalcSquaresWithIconSet() {
        return rx.pipe(
            () => rx.obs.combineLatest(this.iconSetName$, this.titleIndex$),
            rx.withLatestFrom(this.cols$, this.rows$, this.squares$),
            rx.filter(([[iconSetName, titleIndex], cols, rows, squares]) => titleIndex),
            rx.map(([[iconSetName, titleIndex], cols, rows, squares]) => {
                const titleCol = titleIndex % cols;
                const titleEndCol = titleCol + 5;
                const subArrayCols = cols - (titleEndCol + titleCol);
                const iconsCount = iconsMap[iconSetName];

                let newSquares = squares.map(square => _.omit(['icon', 'zIndex', 'boxShadow'], square));

                for (let i = 1; i < iconsCount + 1; i++) {
                    const subColIndex = Math.floor(Math.random() * subArrayCols); // 2
                    const subRowIndex = Math.floor(Math.random() * rows); // 2
                    const realCellIndex = subRowIndex * cols + (subColIndex + titleEndCol);

                    const iconName = `#${iconSetName}_${i}`;

                    newSquares = reDrawSquareWithIcon(realCellIndex, iconName, newSquares);
                }

                return newSquares;
            }),
            rx.tap(squares => this.squares$.next(squares))
        )(null);
    }
}

Controller.$inject = ['$element', '$timeout'];

export const AssetsBackgroundComponent = {
    template,
    controller: Controller,
    bindings: {
        pageTitle: '<',
        squareDefaultLength: '<',
        squareMinWidth: '<',
        rows: '<',
        iconSetName: '<',
    },
};
