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
        icon: "HomeIcon",
        routeName: "side-menu-dashboard",
        title: "Dashboard",
        subMenu: [
          {
            icon: "",
            title: "Overview 1",
            routeName: "side-menu-dashboard-overview-1",
          },
        ],
      },
      {
        icon: "InboxIcon",
        title: "Inbox",
        routeName: "side-menu-inbox",
      },
    ],
  }),
});
