<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-primary bg-gradient">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto" v-if="isLoggedIn">
                            <li class="nav-item">
                                <router-link active-class="active-menu" exact :to="{ name: 'clients' }" class="nav-link">Clientes</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link active-class="active-menu" exact :to="{ name: 'sharedSpaces' }" class="nav-link">Espacios Compartidos</router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" style="cursor: pointer;" @click="logout">Logout</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav" v-else>
                            <li class="nav-item">
                                <router-link to="/login" class="nav-link">Log in</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/register" class="nav-link">Register</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <router-view>
                    <img alt="Vue logo" src="https://static.javatpoint.com/htmlpages/images/robot.jpg" style="float: left; margin-right: 15px;">
                    <h1>Hello World</h1>
                </router-view>
            </div>
        </main>
    </div>
</template>

<script>
export default {
    name: "App",
    data() {
        return {
            isLoggedIn: false,
        }
    },
    created() {
        if (window.Laravel.isLoggedin) {
            this.isLoggedIn = true
        }
    },
    methods: {
        logout(e) {
            e.preventDefault()
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/logout')
                    .then(response => {
                        if (response.data.success) {
                            window.location.reload();
                        } else {
                            console.log(response)
                        }
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
}
</script>
