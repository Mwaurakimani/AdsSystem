import CreatorDashboard from "@/views/Dashboard/CreatorDashboard.vue";
import Pages from "@/views/Dashboard/Pages/Pages.vue";
import Payments from "@/views/Dashboard/Payments/Payments.vue";
import CreatePages from "@/views/Dashboard/Pages/CreatePages.vue";
import ViewPages from "@/views/Dashboard/Pages/ViewPages.vue";
import UpdatePages from "@/views/Dashboard/Pages/UpdatePages.vue";

const creatorRoutes = [
    {
        path: '/creator/dashboard',
        name: 'CreatorDashboard',
        component: CreatorDashboard,
        meta: {
            requiresAuth: true,
            creatorGuard: true
        }
    },
    {
        path: '/creator/pages',
        name: 'CreatorPages',
        component: Pages,
        meta: {
            requiresAuth: true,
            creatorGuard: true
        }
    },
    {
        path: '/creator/pages/create',
        name: 'CreatePage',
        component: CreatePages,
        meta: {
            requiresAuth: true,
            creatorGuard: true
        }
    },
    {
        path: '/creator/pages/view/:id',
        name: 'ViewPage',
        component: ViewPages,
        meta: {
            requiresAuth: true,
            creatorGuard: true
        }
    },
    {
        path: '/creator/pages/edit/:id',
        name: 'UpdatePage',
        component: UpdatePages,
        meta: {
            requiresAuth: true,
            creatorGuard: true
        }
    },
    {
        path: '/creator/payments',
        name: 'CreatorPayments',
        component: Payments,
        meta: {
            requiresAuth: true,
            creatorGuard: true
        }
    }
]

export {creatorRoutes}