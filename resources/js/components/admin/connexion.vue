<template>

</template>

<script>

export default {
    name: "connexion",
    data(){
        return {
            formData : {
                email : '',
                pass:'',
            }

        }
    },
    methods: {
        async connexion() {
            let statut;
            let urlapi = 'http://127.0.0.1:8000/api/login';
            await this.axios.post(urlapi, this.formData).then(response => {
                statut = response.statusCode;
                if (statut == 200) {
                    this.$router.push('/home')
                }else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Mot de Passe Ou Identifiant incorrect'
                    })
                }
            })

        }
    }
}
</script>

<style scoped>

</style>
