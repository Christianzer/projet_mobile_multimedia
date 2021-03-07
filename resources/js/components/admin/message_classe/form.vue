<template>
    <b-modal ref="my-modal" size="xl" :hide-footer="true" :title="title">
        <form  @submit.prevent="save">
            <div class="row">
                <div class="col-md-4">
                    <b-form-group
                        id="code"
                        label-cols-sm="4"
                        label-cols-lg="3"
                        description="Choisir la classe"
                        label="Classe"
                        label-for="input-horizontal"
                    >
                        <b-form-select
                            v-model.trim="formData.matricule"
                            class="text-uppercase"
                            :options="dataClasse"
                            value-field="code"
                            text-field="libelle"
                        ></b-form-select>
                    </b-form-group>
                </div>
                <div class="col-md-4">
                    <b-form-group
                        id="libelle"
                        label-cols-sm="4"
                        label-cols-lg="3"
                        description="Type du message"
                        label="Type Message"
                        label-for="input-horizontal"
                    >
                        <b-form-select
                            class="text-uppercase"
                            :options="dataTypeMessage"
                            value-field="id"
                            text-field="libelle"
                            v-model.trim="formData.type_message"
                        ></b-form-select>
                    </b-form-group>
                </div>
                <div class="col-md-4">
                    <b-form-group
                        id="libelle"
                        label-cols-sm="4"
                        label-cols-lg="3"
                        description="Objet du Message"
                        label="Objet"
                        label-for="input-horizontal"
                    >
                        <b-form-input
                            class="text-uppercase"
                            type="text"
                            v-model.trim="formData.objet"
                        ></b-form-input>
                    </b-form-group>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b-form-group
                        id="code"
                        description="Messsage"
                        label="Message"
                        label-for="input-horizontal"
                    >
                        <b-form-textarea
                            id="textarea"
                            v-model="formData.message"
                            rows="5"
                            max-rows="5"
                        ></b-form-textarea>
                    </b-form-group>
                </div>

            </div>
            <div class="row justify-content-end">
                <b-button variant="success mr-3" type="submit"
                >envoyer
                </b-button
                >
                <b-button @click="closeModal">fermer</b-button>
            </div>
        </form>
    </b-modal>
</template>

<script>
export default {
    name: "form",
    props: {
        selectedTA: {},
        editMode: Boolean
    },
    mounted() {
        this.getEtudiant()
    },
    data () {
        return {
            elementTY: {},
            dataClasse:[],
            dataTypeMessage:[
                {
                    id:1,
                    libelle:'Email'
                },
                {
                    id:2,
                    libelle:'Sms'
                }
            ],
            title: 'Mise à jour message',
            formData: {
                matricule: '',
                type_message:'',
                objet:'',
                message:'',
                element:2

            },
            isloading: false
        }
    },
    methods: {
        showModal() {
            this.formData.matricule = null
            this.formData.type_message=null
            this.formData.objet = null
            this.formData.message = null
            this.$refs['my-modal'].show()
        },
        closeModal () {
            this.$refs['my-modal'].hide()
        },
        async getEtudiant(){
            let urlapi = 'http://127.0.0.1:8000/api/classe';
            await this.axios.get(urlapi).then(response=>{
                this.dataClasse = response.data.listes_classes;
            }).catch((err) => {
                throw err
            })
        },

        async save(){

            this.$Progress.start()
            let  statut;

            console.log(this.formData)
            let urlapi = 'http://127.0.0.1:8000/api/message';
            await this.axios.post(urlapi,this.formData)

                .then(response=>{
                    statut = response.data.status_code;
                    if (statut == 200){
                        Fire.$emit('creationok'); //custom events
                        Toast.fire({
                            icon: 'success',
                            title: 'Message envoyé avec succes'
                        })
                        this.$Progress.finish()
                        this.closeModal()
                    }else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Erreur'
                        })
                        this.$Progress.finish()
                        this.closeModal()
                    }
                }).catch((err) => {
                    throw err
                })



        }

    }
}
</script>

<style scoped>

</style>
