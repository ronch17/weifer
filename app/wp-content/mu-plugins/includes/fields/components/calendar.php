<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$calendar = new FieldsBuilder( 'calendar' );
$calendar
	->addTextarea( 'calendar_widget', [ 'label' => 'Script for Calendar Widget' ] )
	->setDefaultValue( '
		<!-- xs5 Widget : BEGIN -->
		<script src="https://20b7721d591e498f9686-22a90ac259bc30d5e6a957fa879612f3.ssl.cf1.rackcdn.com/widget/_xsWidget.js" type="text/javascript"></script>
		<script>
		var xsWidgetCharts = new XsWidget({
		"containerId": "xswidgetcontainer",
		"language": "en",
		"skin": "white",
		"clickUrl": "' . get_home_url() . '/trading-floor",
		"width": 1366,
		"height": 600,
		"moduleId": "calendar",
		"viewVersion": "standard"
		});
		xsWidgetCharts.init();
		</script>
		<!-- xs5 Widget : END -->
	' );

return $calendar;
