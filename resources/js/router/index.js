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
    },
    {
        path: '/admin/dashboard',
        name: 'AdminDashboard',
        component: () => import('../pages/AdminDashboardPage.vue')
    },
    {
        path: '/admin/employees',
        name: 'AdminEmployees',
        component: () => import('../pages/AdminEmployeesPage.vue')
    },
    {
        path: '/admin/medical-leaves',
        name: 'AdminMedicalLeaves',
        component: () => import('../pages/AdminMedicalLeavesPage.vue')
    },
    {
        path: '/admin/api-logs',
        name: 'AdminApiLogs',
        component: () => import('../pages/AdminApiLogsPage.vue')
    },
    {
        path: '/airport-pos',
        name: 'AirportPOS',
        component: () => import('../pages/AirportPOSPage.vue'),
        meta: { requiresAuth: false }
    },
    {
        path: '/medical-leave',
        name: 'MedicalLeave',
        component: () => import('../pages/MedicalLeavePage.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/parking-permit',
        name: 'ParkingPermit',
        component: () => import('../pages/ParkingPermitPage.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/visitor-parking/:visitorToken',
        name: 'VisitorParkingClaim',
        component: () => import('../pages/VisitorParkingClaimPage.vue'),
        meta: { requiresAuth: false }
    },
    {
        path: '/admin/visitor-parking',
        name: 'AdminVisitorParking',
        component: () => import('../pages/AdminVisitorParkingPage.vue')
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
