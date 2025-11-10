import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: () => import('../pages/HomePage.vue')
    },
    {
        path: '/prerequisite-vc',
        name: 'PrerequisiteVC',
        component: () => import('../pages/PrerequisiteVCPage.vue')
    },
    {
        path: '/apply',
        name: 'Apply',
        component: () => import('../pages/ApplyPage.vue')
    },
    {
        path: '/congratulations',
        name: 'Congratulations',
        component: () => import('../pages/CongratulationsPage.vue'),
        meta: { requiresAuth: false }
    },
    {
        path: '/employee-credential',
        name: 'EmployeeCredential',
        component: () => import('../pages/EmployeeCredentialPage.vue'),
        meta: { requiresAuth: false }
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import('../pages/LoginPage.vue')
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: () => import('../pages/DashboardPage.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/admin',
        name: 'Admin',
        component: () => import('../pages/AdminDashboardPage.vue')
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// Token 認證守衛
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('auth_token')

    if (to.meta.requiresAuth && !token) {
        next({ name: 'Login' })
    } else {
        next()
    }
})

export default router
