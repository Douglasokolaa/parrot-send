import route from "ziggy-js/src/js";

// Setup side menu
const findActiveMenu = (menu) => {
  let active = false;
    menu.forEach((item, key) => {
      if (route().current(item.routeName)) {
        active = true;
      }
    })
    return active;
};

const nestedMenu = (menu) => {
  menu.forEach((item, key) => {
    if (typeof item !== "string") {
      let menuItem = menu[key];
      menuItem.active = !item.subMenu ? route().current(item.routeName) : findActiveMenu(item.subMenu)

      if (item.subMenu) {
        menuItem.activeDropdown = findActiveMenu(item.subMenu);
        menuItem = {
          ...item,
          ...nestedMenu(item.subMenu),
        };
      }
    }
  });

  return menu;
};

export { nestedMenu, findActiveMenu};
