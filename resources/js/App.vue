<template>
  <div
    id="main-wrapper"
    data-layout="vertical"
    data-navbarbg="skin5"
    data-sidebartype="full"
    data-sidebar-position="absolute"
    data-header-position="absolute"
    data-boxed-layout="full"
  >
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header-layout></header-layout>

    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside-layout></aside-layout>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper" v-loading="loading">
      <!-- ============================================================== -->
      <!-- Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <!-- <el-button @click="goBack" v-if="show_back">
                <i class="el-icon-back"></i> Back
            </el-button> -->
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li>
                  <a href="#" class="fw-normal">{{ breadcrumb }}</a>
                </li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- ============================================================== -->
      <!-- End Bread crumb and right sidebar toggle -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <router-view></router-view>

      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- footer -->
      <!-- ============================================================== -->
      <footer class="footer text-center">
        2021 © Ample Admin brought to you by
        <a href="https://www.wrappixel.com/">wrappixel.com</a>
      </footer>
      <!-- ============================================================== -->
      <!-- End footer -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
  </div>
  <!-- <div>
        <router-view></router-view>
    </div> -->
</template>
<script>
import AsideLayout from './layouts/AsideLayout.vue'
import HeaderLayout from './layouts/HeaderLayout.vue'
import {mapState, mapActions} from 'vuex'
export default {
    components: {
        AsideLayout,
        HeaderLayout,
    },
    computed: mapState({
        loading: (state) => state.loading,
        show_back: (state) => state.show_back,
        breadcrumb: (state) => state.breadcrumb,
    }),
    mounted() {
        const route_name = String(this.$route.name).toString()
        this.setBreadcrumb(
            route_name.substring(0, 1).toUpperCase() + route_name.slice(1),
        )
        window.Bus.$on('go-back', this.goBack)
    },
    methods: {
        ...mapActions(['setBreadcrumb', 'setCurrentRouteName']),
        goBack() {
            this.$router.back()
        },
    },
    watch: {
        $route(value) {
            this.setCurrentRouteName(value.name)
            this.setBreadcrumb(
                value.name.substring(0, 1).toUpperCase() + value.name.slice(1),
            )
        },
    },
}
</script>
