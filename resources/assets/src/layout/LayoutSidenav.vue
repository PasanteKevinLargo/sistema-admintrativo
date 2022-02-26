<template>
  <sidenav :orientation="orientation" :class="curClasses">

    <!-- Inner -->
    <div class="sidenav-inner" :class="{ 'py-1': orientation !== 'horizontal' }">
      <sidenav-router-link icon="ion ion-ios-contact" to="/home" :exact="true" v-if="idrol==2">Tablerozz</sidenav-router-link>

         <!-- Menu del sistema-->
  
      <sidenav-menu icon="ion ion-md-speedometer" :active="isMenuActive('/Administracion')" :open="isMenuOpen('/Administracion')" v-if="idrol==1">
        <template slot="link-text">Administración</template>
        <sidenav-router-link icon="ion ion-md-desktop" to="/v-usuario" :exact="true">Usuarios</sidenav-router-link>
        <sidenav-router-link icon="ion ion-md-desktop" to="/v-clientes" :exact="true">Clientes</sidenav-router-link>
        <sidenav-router-link icon="ion ion-md-desktop" to="/v-servicios" :exact="true">Servicios</sidenav-router-link>
        <sidenav-router-link icon="ion ion-md-desktop" to="/v-contratos" :exact="true">Productos</sidenav-router-link>


         <!-- Menu Referencial-->

          <sidenav-menu icon="ion ion-md-speedometer" :active="isMenuActive('/Parametros')" :open="isMenuOpen('/Parametros')" v-if="idrol==1">
          <template slot="link-text">Parámetros</template>
           <sidenav-router-link icon="ion ion-md-desktop" to="/v-financiador" :exact="true">Financiador/Ejecutor</sidenav-router-link>
          <sidenav-router-link icon="ion ion-md-desktop" to="/v-proveedor" :exact="true">Proveedores</sidenav-router-link>
          <sidenav-router-link icon="ion ion-md-desktop" to="/v-firma" :exact="true">Firmas</sidenav-router-link>
          <sidenav-router-link icon="ion ion-md-desktop" to="/v-titulodocumento" :exact="true">Titulo Documento</sidenav-router-link>
          <sidenav-router-link icon="ion ion-md-desktop" to="/v-titulo" :exact="true">Titulo</sidenav-router-link>
          <sidenav-router-link icon="ion ion-md-desktop" to="/v-iva" :exact="true">Iva</sidenav-router-link>
          <sidenav-router-link icon="ion ion-md-desktop" to="/v-personal" :exact="true">Personal</sidenav-router-link>
          <sidenav-router-link icon="ion ion-md-desktop" to="/v-entidad" :exact="true">Entidad Autoriza</sidenav-router-link>
          <sidenav-router-link icon="ion ion-md-desktop" to="/v-tipoadjunto" :exact="true">Tipos de Adjuntos</sidenav-router-link>
          </sidenav-menu>

          <sidenav-menu icon="ion ion-md-speedometer" :active="isMenuActive('/Contabilidad')" :open="isMenuOpen('/Contabilidad')" v-if="idrol==1">
          <template slot="link-text">Contabilidad</template>
          <sidenav-router-link icon="ion ion-md-desktop" to="/home" :exact="true">Plan de Cuentas</sidenav-router-link>
          <sidenav-router-link icon="ion ion-md-desktop" to="/home" :exact="true">Plan de Cuentas Internacional</sidenav-router-link>
          </sidenav-menu>

          <sidenav-menu icon="ion ion-md-speedometer" :active="isMenuActive('/Stock')" :open="isMenuOpen('/Stock')" v-if="idrol==1">
          <template slot="link-text">Stock</template>
          <sidenav-router-link icon="ion ion-md-desktop" to="/home" :exact="true">Productos</sidenav-router-link>
          <sidenav-router-link icon="ion ion-md-desktop" to="/home" :exact="true">Kárdex</sidenav-router-link>
          </sidenav-menu>

      </sidenav-menu>
      

      

    </div>
  </sidenav>
</template>

<script>
import { Sidenav, SidenavLink, SidenavRouterLink, SidenavMenu, SidenavHeader, SidenavBlock, SidenavDivider } from '@/vendor/libs/sidenav'

export default {
  name: 'app-layout-sidenav',
  components: {
    Sidenav,
    SidenavLink,
    SidenavRouterLink,
    SidenavMenu,
    SidenavHeader,
    SidenavBlock,
    SidenavDivider
  },
  data: () => ({
    idrol:0,
  }),

  props: {
    orientation: {
      type: String,
      default: 'vertical'
    }
  },

  computed: {
    curClasses () {
      let bg = this.layoutSidenavBg

      if (this.orientation === 'horizontal' && (bg.indexOf(' sidenav-dark') !== -1 || bg.indexOf(' sidenav-light') !== -1)) {
        bg = bg
          .replace(' sidenav-dark', '')
          .replace(' sidenav-light', '')
          .replace('-darker', '')
          .replace('-dark', '')
      }

      return `bg-${bg} ` + (
        this.orientation !== 'horizontal'
          ? 'layout-sidenav'
          : 'layout-sidenav-horizontal container-p-x flex-grow-0'
      )
    }
  },

  methods: {
    isMenuActive (url) {
      return this.$route.path.indexOf(url) === 0
    },

    isMenuOpen (url) {
      return this.$route.path.indexOf(url) === 0 && this.orientation !== 'horizontal'
    },

    toggleSidenav () {
      this.layoutHelpers.toggleCollapsed()
    },
    getPerfilUsuario(){
        let me=this;
        var url= '/user/getPerfilUsuario';
        axios.get(url).then(function (response) {
            console.log(response);
            var respuesta=response.data;
            me.idrol = respuesta.perfil;

        })
        .catch(function (error) {
            // handle error
            console.log(error);
        });
    },
  },
  mounted() {
            this.getPerfilUsuario();
        }
}
</script>
