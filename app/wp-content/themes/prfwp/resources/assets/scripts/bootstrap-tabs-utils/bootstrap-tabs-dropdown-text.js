const updateButtonDropdownText = ($ButtonDropdown, $tab) => {
    const tabActive = $tab.filter('.active').html();

    $ButtonDropdown.html(tabActive);
};

export default updateButtonDropdownText;
