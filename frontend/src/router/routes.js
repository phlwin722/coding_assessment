const routes = [
  {
    path: "/",
    redirect: "/login",
  },
  {
    path: "/",
    component: () => import("layouts/Defaultlayout.vue"),
    children: [
      {
        path: "login",
        component: () => import("pages/loginPage.vue"),
      },
    ],
  },
  {
    path: "/admin",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "product",
        component: () => import("pages/Admin/productPage.vue"),
      },
      {
        path: "product/form/:id?",
        component: () => import("pages/Admin/productFormPage.vue"),
      },
      {
        path: "videos",
        component: () => import("pages/Admin/videosPage.vue"),
      }
    ],
  },

  // 404 route
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
