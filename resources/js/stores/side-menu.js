import { defineStore } from "pinia";

export const useSideMenuStore = defineStore("sideMenu", {
  state: () => ({
    menu: [
      {
        icon: "HomeIcon",
        title: "Dashboard",
        routeName: "dashboard",
      },
      {
        icon: "PhoneIcon",
        title: "Phonebook",
        routeName: "phonebooks.index",
      },
      {
        icon: "HomeIcon",
        routeName: "current-team.update",
        title: "Nested Menu",
        subMenu: [
          {
            icon: "",
            title: "Overview 1",
            routeName: "current-team.update",
          },
        ],
      },
    ],
  }),
});
