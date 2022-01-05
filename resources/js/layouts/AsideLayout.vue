<template>
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="in">
                    <!-- User Profile-->
                    <li class="sidebar-item pt-2 selected">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="javascript:void(0)"
                            @click="goto('/')" aria-expanded="false">
                            <i class="fa fa-th-large" aria-hidden="true"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)"
                            @click="goto('/projects')" aria-expanded="false">
                            <i class="fa fa-th" aria-hidden="true"></i>
                            <span class="hide-menu">Projects</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)"
                            @click="goto('/users')" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="javascript:void(0)"
                            @click="goto('/tasks')" aria-expanded="false">
                            <i class="fa fa-tasks" aria-hidden="true"></i>
                            <span class="hide-menu">Tasks</span>
                        </a>
                    </li>

                </ul>

            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
</template>
<script>
export default {
    setup() {

    },
    methods: {
        goto(path_name) {
            this.$router.push(path_name)
        },
    },
}

</script>
