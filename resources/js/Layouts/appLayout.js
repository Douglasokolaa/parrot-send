import route from "ziggy-js/src/js";

// Setup side menu
const findActiveMenu = (routeName) => {
  return route().current(routeName);
};

const nestedMenu = (menu) => {
  menu.forEach((item, key) => {
    if (typeof item !== "string") {
      let menuItem = menu[key];
      menuItem.active = true

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
