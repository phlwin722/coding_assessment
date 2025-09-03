import { defineRouter } from "#q-app/wrappers";
import { createRouter, createWebHistory, createWebHashHistory } from "vue-router";
import routes from "./routes"; 

export default defineRouter(function () {
  const createHistory = process.env.SERVER
    ? createMemoryHistory
    : process.env.VUE_ROUTER_MODE === "history"
    ? createWebHistory
    : createWebHashHistory;

  const Router = createRouter({
    history: createHistory(process.env.VUE_ROUTER_BASE),
    routes,
    scrollBehavior: () => ({ left: 0, top: 0 }),
  });

  Router.beforeEach((to, from, next) => {
    const userToken =
      localStorage.getItem("access_token") || sessionStorage.getItem("access_token");

    if (to.path === "/" && userToken) {
      next("/admin/product");
    }

    else if (!userToken && to.path.startsWith("/admin")) {
      next("/login");
    }

    else if (userToken && to.path === "/login") {
      next("/admin/product");
    }

    else {
      next();
    }
  });

  return Router;
});
