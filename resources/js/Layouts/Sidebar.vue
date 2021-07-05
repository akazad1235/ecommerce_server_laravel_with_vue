<template>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner "  >
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li >Supper Admin</li>

                    <!-- Client Manager start-->
                    <li class="submenu">
                      <a>
                          <i class="fa fa-users"></i> <span> Client Manager </span> <span class="menu-arrow"></span>
                      </a>
                    <ul class="child-menu" :style="getMenu('user')">

                     <li :class="getRoute('home.index')" >
                          <jet-responsive-nav-link :href="route('home.index')" :active="route().current('home.index')">
                            <span> Manage Users </span>
                          </jet-responsive-nav-link>
                     </li>
<!--                        <jet-responsive-nav-link :href="route('home.index')" :active="route().current('home.index')">-->
<!--                            <span> Manage Users </span>-->
<!--                          </jet-responsive-nav-link>-->

                            <!-- <li>
                          <jet-responsive-nav-link >
                            <span> Manage Users </span>
                          </jet-responsive-nav-link>
                        </li>
                        <li >
                            <jet-responsive-nav-link >
                                <span> Organizations </span>
                            </jet-responsive-nav-link>
                        </li> -->



                      </ul>
                    </li>
                      <!-- Client Manager end-->
               <!--**************_ Start Product_******************-->
                    <li class="submenu">
                      <a>
                          <i class="fa fa-users"></i> <span> Products </span> <span class="menu-arrow"></span>
                      </a>
                      <ul class="child-menu" >
                        <jet-responsive-nav-link :href="route('home.product')" :active="route().current('home.product')">
                            <span> Products</span>
                          </jet-responsive-nav-link>



                      </ul>
                    </li><!--**************_ Start Product_******************-->

               <!--**************_ Start Brand_******************-->
                    <li class="submenu">
                        <a>
                            <i class="fa fa-users"></i> <span> Brand </span> <span class="menu-arrow"></span>
                        </a>
                        <ul class="child-menu" >
                            <jet-responsive-nav-link :href="route('home.brand')" :active="route().current('home.brand')">
                                <span> Brand</span>
                            </jet-responsive-nav-link>

                        </ul>
                    </li><!--**************_ Start Brand_******************-->

                    <!--**************_ Start Category_******************-->
                    <li class="submenu">
                        <a>
                            <i class="fa fa-users"></i> <span> Categores </span> <span class="menu-arrow"></span>
                        </a>
                        <ul class="child-menu" :style="getMenu('categories')">
                            <jet-responsive-nav-link :href="route('categories.index')" :active="route().current('categories.index')">
                                <span>All Categories</span>
                            </jet-responsive-nav-link>
                        </ul>
                    </li><!--**************_ Start Category_******************-->
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

export default {
    props: ['croute','data'],
    data () {
        return {
            options:{
                height:'100%',
                size:2
            },
        }
    },
    components: {
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
    },
    methods: {
        getRoute(path) {
            if(this.croute === path) {
                return 'active'
            }
        },

        // goBackDashboard(){
        //     this.$inertia.get('/dashboard');
        // },
        getMenu(menu) {
            // const user = [
            //     'admins.index', 'admins.create', 'admins.edit','admins.show','admin/reset','admin/password',
            //     'permissions.index','permissions.create',
            //     'organization-users.index', 'organization-users.create', 'organization-users.edit','organization-users.show','organization.changePassword'
            // ]
            // const organization = ['organization-users.index', 'organization-users.create']
             const user= ['home.index'];
             const categories= ['categories.create', 'categories.index'];

            if(menu === 'user' && user.includes(this.croute)) {
                return 'display: block;'
            }
            if(menu === 'categories' && categories.includes(this.croute)) {
                return 'display: block;'
            }

            return 'display: none;'
        }
    }
}
</script>

<style >
.child-menu {
    padding-left: 10%!important;
}
</style>
