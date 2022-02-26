import Vue from 'vue'
import Router from 'vue-router'
import Meta from 'vue-meta'
import NotFound from '@/components/NotFound'

import globals from '@/globals'

// Layouts
import Layout1 from '@/layout/Layout1'

Vue.use(Router)
Vue.use(Meta)

const router = new Router({
  base: '/',
  mode: 'history',
  routes: [{
    path: '/',
    component: Layout1,
    children: [{
      path: 'home',
      component: () => import('@/components/Home')
    }, {
      path: 'v-proyecto',
      component: () => import('@/components/01Proyecto')
    },{
      path: 'v-oficio',
      component: () => import('@/components/10Oficio')
    },{
      path: 'v-tipoadjunto',
      component: () => import('@/components/6-1-Tipoadjunto')
    },{
      path: 'v-contrato',
      component: () => import('@/components/02Contrato')
    },{
      path: 'v-compra',
      component: () => import('@/components/03Compra')
    },{
      path: 'v-financiador',
      component: () => import('@/components/6-2-Financiador')
    },{
      path: 'v-personal',
      component: () => import('@/components/6-3-Personal')
    },{
      path: 'v-entidad',
      component: () => import('@/components/6-4-EntidadAutoriza')
    },{ /*editado por el pasante*/
      path: 'v-proveedor',
      component: () => import('@/components/6-5-Proveedor')
    },{ /*editado por el pasante*/
      path: 'v-firma',
      component: () => import('@/components/6-6-Firmas')
    },{ /*editado por el pasante*/     
      path: 'v-titulodocumento',
      component: () => import('@/components/6-7-TituloDocumento.vue')
    },{ /*editado por el pasante*/     
      path: 'v-titulo',
      component: () => import('@/components/6-8-Titulo.vue')
    },{ /*editado por el pasante*/     
      path: 'v-iva',
      component: () => import('@/components/6-9-Iva.vue')
    },{
      path: 'v-usuario',
      component: () => import('@/components/6-0-User')
    },{/*Es el apodo de clientes para el sitema de administracion*/
      path: 'v-clientes',
      component: () => import('@/components/4-1-Clientes.vue')
    },{/*Es el apodo de servicios para el sitema de administracion*/
      path: 'v-servicios',
      component: () => import('@/components/4-2-Servicios.vue')
    },{/*Es el apodo de contratos para el sitema de administracion*/
      path: 'v-contratos',
      component: () => import('@/components/4-3-Contratos.vue')
    }]
  }, {
    // 404 Not Found page
    path: '*',
    component: NotFound
  }, ]
})

router.afterEach(() => {
  // On small screens collapse sidenav
  if (window.layoutHelpers && window.layoutHelpers.isSmallScreen() && !window.layoutHelpers.isCollapsed()) {
    setTimeout(() => window.layoutHelpers.setCollapsed(true, true), 10)
  }

  // Scroll to top of the page
  globals().scrollTop(0, 0)
})

router.beforeEach((to, from, next) => {
  // Set loading state
  document.body.classList.add('app-loading')

  // Add tiny timeout to finish page transition
  setTimeout(() => next(), 10)
})

export default router
