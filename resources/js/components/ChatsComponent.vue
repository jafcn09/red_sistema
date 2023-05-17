<template>
    <div class="row">
        <div class="col-8">
            <div class="card card-default">
                <div class="card-header">Mesasges</div>
                <div class="card-body p-0">
                    <ul class="list-unstyled" style="height:300px; overflow-y:scroll">
                        <li class="p-2" v-for="(message, index) in messages" :key="index"></li>
                        <strong>{{ message.user.nombres }}</strong>
                        {{ message.message }}

                    </ul>
                </div>
                <input type="text" name="message" placeholder="Ingrese su mensaje" class="form-control">
            </div>
            <span class="text-muted">Usuario esta escribiendo</span>
        </div>

        <div class="col-4">
            <div class="card card-default">
                <div class="card-header">Active Users</div>
                <div class="card-body">
                    <ul class="list-unstyled" style="height:300px; overflow-y:scroll">
                        <li class="py-2">Harris</li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    var vm = new Vue({
        data(){
            return {
                messages: ''
            }
        },
        created(){
            this.fetchMessages();
        },
        methods:{
            fetchMessages(){
                axios.get('messages').then(response => {
                    this.messages = response.data;
                })
            }
        }
    })
</script>
