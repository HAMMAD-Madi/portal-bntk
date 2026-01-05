// menuItems.js
export const menuItems = [
    {
        name: "Home",
        url: '/'
    },
    {
        name: "Voorraad",
        icon: 'fa-cubes',
        children: [
            {
                name: "Overzicht",
                url: '/voorraad'
            },
            {
                name: "Nieuw product",
                url: '/voorraad/nieuw'
            },
            {
                name: "Batches uploaden",
                url: '/voorraad/bulk'
            },
            {
                name: "Categorieën",
                url: '/categorieen'
            },
            {
                name: "Nieuwe categorie",
                url: '/categorieen/nieuw'
            },

            {
                name: "Investeringsvoorraad",
                url: '/voorraad/investment'
            },
            {
                name: "Voorraad locaties",
                url: '/voorraad/locations'
            },
        ],
    },
    {
        name: "Shipping",
        icon: 'fa-truck',
        url: '/voorraad/verzending'

        // children: [
        //     {
        //         name: "Overview",
        //         url: '/voorraad/verzending'
        //     },
        //     // {
        //     //     name: "New Shipment",
        //     //     url: '/shipping/new'
        //     // },
        //     // {
        //     //     name: "Batch Upload",
        //     //     url: '/shipping/bulk'
        //     // },
        //     // {
        //     //     name: "Categories",
        //     //     url: '/categories'
        //     // },
        //     // {
        //     //     name: "New Category",
        //     //     url: '/categories/new'
        //     // },
        // ],
    },
    {
        name: "Orders",
        icon: 'fa-basket-shopping',
        url: '/orders'
    },
    {
        name: "Facturen",
        icon: 'fa-file-invoice',
        children: [
            {
                name: "Overzicht",
                url: '/facturen'
            }, 
            {
                name: "Factuuraanvragen",
                url: '/factuuraanvragen'
            },   
            {
                name: "Nieuw factuur",
                url: '/facturen/nieuw'
            },
            {
                name: "Klanten",
                url: '/klanten'
            }
        ]
    }
  ];