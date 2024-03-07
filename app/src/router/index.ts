/**
 * router/index.ts
 *
 * Automatic routes for `./src/pages/*.vue`
 */

// Composables
import CheckUser from '@/services/CheckUser';
import { Router } from 'vue-router';
import { createRouter, createWebHistory } from 'vue-router/auto';

const router: Router = createRouter({
  extendRoutes: (routes: any) => {
    routes.map((route: any) => {
      if (route.path === '/login') {
        route.meta ??= {};
        route.meta.requiresAuth = false;
        return;
      }

      route.meta ??= {};
      route.meta.requiresAuth = true;
    });

    // the return is completely optional since we are modifying the routes in place
    return routes;
  },
  history: createWebHistory(process.env.BASE_URL),
});

router.beforeEach((to, from) => {
  console.log({
    to,
    from,
    authRequired: to.meta.requiresAuth,
    isLoggedIn: CheckUser.isUserSet(),
    user: CheckUser.getUser(),
  });

  if (to.meta.requiresAuth) {
    if (CheckUser.isUserSet()) {
      return true;
    } else {
      router.push('/login');
    }
  }

  return true;
});

export default router;
