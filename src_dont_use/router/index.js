import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth';
import Home from '../views/Home.vue'
import Categories from '../components/Categories.vue';
import Category from '../components/Category.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    meta: { title: 'Home' },
    component: Home
  },
  {
    path: '/voorraad',
    name: 'InventoryIndex',
    meta: { title: 'Inventory Overzicht' },
    component: () => import(/* webpackChunkName: "InventoryIndex" */ '@/views/inventory/InventoryIndex.vue'),
  },
  {
    path: '/voorraad/nieuw',
    name: 'inventory-new',
    props: true,
    meta: { title: 'Nieuw Product' },
    component: () => import(/* webpackChunkName: "Inventory" */ '@/views/inventory/InventoryNew.vue'),
  },
  {
    path: '/voorraad/bulk',
    name: 'inventory-new-batches-uploaden',
    props: true,
    meta: { title: 'Nieuwe producten in batches uploaden' },
    component: () => import(/* webpackChunkName: "Inventory" */ '@/views/inventory/BatchUpload.vue'),
  },
  {
    path: '/voorraad/:gtin',
    name: 'inventory-product',
    props: true,
    meta: { title: 'Bekijk Voorraad' },
    component: () => import(/* webpackChunkName: "Inventory" */ '@/views/inventory/InventoryProduct.vue'),
  },
 
  // {
  //   path: '/categorieen/:id?/:slug?',
  //   name: 'inventory-category',
  //   props: true,
  //   component: () => import(/* webpackChunkName: "Categorieen" */ '@/views/inventory/Categories.vue'),
  // },
  {
    path: '/facturen',
    name: 'Facturen overzicht',
    meta: { title: 'Facturen Overzicht' },
    component: () => import(/* webpackChunkName: "invoiceIndex" */ '@/views/invoices/InvoiceIndex.vue'),
  },
  {
    path: '/factuuraanvragen',
    name: 'Facturenaanvragen',
    meta: { title: 'Factuuraanvragen' },
    component: () => import(/* webpackChunkName: "InvoiceRequests" */ '@/views/invoice_requests/InvoiceRequests.vue'),
  },
  {
    path: '/orders',
    name: 'Orders',
    meta: { title: 'Orders' },
    component: () => import(/* webpackChunkName: "Orders" */ '@/views/orders/OrdersIndex.vue'),
  },
  {
    path: '/orders/:order_id',
    props:true,
    name: 'OrderPage',
    meta: { title: 'Inventory Weergave' },
    component: () => import(/* webpackChunkName: "OrderPage" */ '@/views/orders/OrderPage.vue'),
  },
  {
    path: '/factuuraanvragen/:order_id',
    name: 'Facturenaanvraag',
    props: true,
    meta: { title: 'Factuuraanvragen Weergave' },
    component: () => import(/* webpackChunkName: "InvoiceRequest" */ '@/views/invoice_requests/InvoiceRequest.vue'),
  },
  // {
  //   path: '/categorieen',
  //   name: 'categories',
  //   children: [
  //     {
  //       path: '/',
  //       name: 'inventory-category-new',
  //       props: true,
  //       component: () => import(/* webpackChunkName: "Categories" */ '@/views/inventory/Categories.vue'),
  //     }, 
  //     {
  //       path: '/nieuw',
  //       name: 'inventory-category-new',
  //       props: true,
  //       component: () => import(/* webpackChunkName: "NewCategorieen" */ '@/views/inventory/NewCategory.vue'),
  //     }, 
  //     {
  //       path: ':id',
  //       name: 'category',
  //       props: true,
  //       component: () => import(/* webpackChunkName: "Category" */ '@/components/Category.vue'),
  //     },

  //   ]
  // },

  {
    path: '/categorieen',
    name: 'categories',
    meta: { title: 'categorieen' },

    component: () => import(/* webpackChunkName: "Categories-passthrough" */ '@/views/PassThrough.vue'),
    children: [
      {
        path: '', // default path for the index page (all categories)
        name: 'categories-index',
        props: true,
        component: () => import(/* webpackChunkName: "Categories" */ '@/views/inventory/Categories.vue'),
      },
      {
        path: 'nieuw', // path for creating a new category
        name: 'inventory-category-new',
        props: true,
        meta: { title: 'Nieuw Categorie' },
        component: () => import(/* webpackChunkName: "NewCategorieen" */ '@/views/inventory/NewCategory.vue'),
      },
      {
        path: ':id', // dynamic route for a single category
        name: 'category',
        props: true,
        meta: { title: 'Categorie bekijken' },
        component: () => import(/* webpackChunkName: "Category" */ '@/components/Category.vue'),
      },
    ],
  },
  {
    path: '/facturen/:number',
    name: 'Factuur bewerken',
    props: true,
    meta: { title: 'Factuur Bewerken' },
    component: () => import(/* webpackChunkName: "invoiceEdit" */ '@/views/invoices/InvoiceEdit.vue')
  },
  {
    path: '/facturen/nieuw',
    name: 'Nieuw factuur',
    props: true,
    meta: { title: 'Nieuw factuur' },
    component: () => import(/* webpackChunkName: "invoiceNew" */ '@/views/invoices/InvoiceNew.vue')
  },
  {
    path: '/klanten',
    name: 'Klanten overzicht',
    meta: { title: 'Klanten overzicht' },
    component: () => import(/* webpackChunkName: "ContactIndex" */ '@/views/contact/ContactIndex.vue'),
  },
  {
    path: '/klanten/:number',
    name: 'Klant bewerken',
    props: true,
    meta: { title: 'Klant bewerken' },
    component: () => import(/* webpackChunkName: "ContactEdit" */ '@/views/contact/ContactEdit.vue')
  },  
  {
    path: '/klant/nieuw',
    name: 'Nieuw klant',
    props: true,
    meta: { title: 'Nieuw klant' },
    component: () => import(/* webpackChunkName: "ContactNew" */ '@/views/contact/ContactNew.vue')
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import(/* webpackChunkName: "login" */ '@/views/Login.vue'),
    meta: { layout: 'guest' }
  },
  {
    path: '/niet-gevonden',
    name: '404',
    component: () => import(/* webpackChunkName: "404" */ '@/views/NotFoundPage.vue')
  },
  {
    path: '/voorraad/verzending',
    name: 'shipping-packages',
    meta: { title: 'Verzendingen' },
    component: () => import(/* webpackChunkName: "ShippingPackages" */ '@/views/inventory/ShippingPackages.vue'),
  },
  {
    path: '/voorraad/verzending/pending',
    name: 'shipping-pending',
    meta: { title: 'In Behandeling' },
    component: () => import(/* webpackChunkName: "ShippingPackages" */ '@/views/inventory/ShippingPackages.vue'),
    props: { status: 'pending' }
  },
  {
    path: '/voorraad/verzending/ready',
    name: 'shipping-ready',
    meta: { title: 'Klaar voor Verzending' },
    component: () => import(/* webpackChunkName: "ShippingPackages" */ '@/views/inventory/ShippingPackages.vue'),
    props: { status: 'ready' }
  },
  {
    path: '/voorraad/verzending/shipped',
    name: 'shipping-shipped',
    meta: { title: 'Verzonden' },
    component: () => import(/* webpackChunkName: "ShippingPackages" */ '@/views/inventory/ShippingPackages.vue'),
    props: { status: 'shipped' }
  },
  {
    path: '/voorraad/locations',
    name: 'stock-locations',
    meta: { title: 'Voorraad Locaties' },
    component: () => import('@/views/inventory/LocationManagement.vue')
  },
  {
    path: '/voorraad/investment',
    name: 'investment-stock',
    meta: { title: 'Investeringsvoorraad' },
    component: () => import('@/views/inventory/InvestmentStock.vue')
  }
]
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})


router.beforeEach(async (to) => {
  // redirect to login page if not logged in and trying to access a restricted page
  const publicPages = ['/login', '/'];
  const authRequired = !publicPages.includes(to.path);
  const auth = useAuthStore();

  if(authRequired) {
    auth.returnUrl = to.fullPath;
  }


  if (authRequired && !auth.user) {
      return '/login';
  }
});

export default router

