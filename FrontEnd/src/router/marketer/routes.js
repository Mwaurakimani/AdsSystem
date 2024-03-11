import MarketerDashboard from "@/views/Dashboard/MarketerDashboard.vue";
import Campaigns from "@/views/Dashboard/Campaigns/Campaigns.vue";
import CreateCampaigns from "@/views/Dashboard/Campaigns/CreateCampaigns.vue";
import ViewCampaigns from "@/views/Dashboard/Campaigns/ViewCampaigns.vue";
import updateCampaigns from "@/views/Dashboard/Campaigns/UpdateCampaigns.vue";
import ViewStats from "@/views/Dashboard/Campaigns/ViewStats.vue";

const marketerRoutes = [
    {
        path: '/marketer/dashboard',
        name: 'MarketerDashboard',
        component: MarketerDashboard,
        meta: {
            requiresAuth: true,
            marketerGuard: true
        }

    },
    {
        path: "/marketer/campaigns",
        name: "MarketingCampaigns",
        component: Campaigns,
        meta: {
            requiresAuth: true,
            marketerGuard: true
        }

    },
    {
        path: "/marketer/campaigns/create",
        name: "MarketingCampaignsCreate",
        component: CreateCampaigns,
        meta: {
            requiresAuth: true,
            marketerGuard: true
        }
    },
    {
        path: "/marketer/campaigns/view/:id",
        name: "viewCampaign",
        component: ViewCampaigns,
        meta: {
            requiresAuth: true,
            marketerGuard: true
        }
    },
    {
        path: "/marketer/campaigns/edit/:id",
        name: "editCampaigns",
        component: updateCampaigns,
        meta: {
            requiresAuth: true,
            marketerGuard: true
        }
    },
    {
        path: "/marketer/campaigns/:id/stats",
        name: "ViewStats",
        component: ViewStats,
        meta: {
            requiresAuth: true,
            marketerGuard: true
        }
    },
]

export {
    marketerRoutes
}