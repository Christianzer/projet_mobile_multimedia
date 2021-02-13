<template>
    <b-modal ref="my-modal" size="lg" :hide-footer="true" :title="title">
        <form  @submit.prevent="save">
            <div class="row">
                <div class="col-md-6">
                    <b-form-group
                        id="code"
                        label-cols-sm="4"
                        label-cols-lg="3"
                        description="Matricule unique etudiant"
                        label="Matricule"
                        label-for="input-horizontal"
                    >
                        <b-form-input
                            v-model.trim="formData.matricule"
                            class="w-auto text-uppercase"
                            id="code"
                        ></b-form-input>
                    </b-form-group>
                </div>
                <div class="col-md-6">
                    <b-form-group
                        id="libelle"
                        label-cols-sm="4"
                        label-cols-lg="3"
                        description="Nom etudiant"
                        label="Nom"
                        label-for="input-horizontal"
                    >
                        <b-form-input
                            class="w-auto text-uppercase"
                            type="text"
                            v-model.trim="formData.nom"
                        ></b-form-input>
                    </b-form-group>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b-form-group
                        id="code"
                        label-cols-sm="4"
                        label-cols-lg="3"
                        description="Prenoms etudiant"
                        label="Prenoms"
                        label-for="input-horizontal"
                    >
                        <b-form-input
                            v-model.trim="formData.prenoms"
                            class="w-auto text-uppercase"
                            id="code"
                        ></b-form-input>
                    </b-form-group>
                </div>
                <div class="col-md-6">
                    <b-form-group
                        id="libelle"
                        label-cols-sm="4"
                        label-cols-lg="3"
                        description="Contact etudiant"
                        label="Contact"
                        label-for="input-horizontal"
                    >
                        <b-form-input
                            class="w-auto"
                            type="text"
                            v-model.trim="formData.nom"
                        ></b-form-input>
                    </b-form-group>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <b-form-group
                        id="code"
                        label-cols-sm="4"
                        label-cols-lg="3"
                        description="Email etudiant"
                        label="Email"
                        label-for="input-horizontal"
                    >
                        <b-form-input
                            type="email"
                            v-model.trim="formData.email"
                            class="w-auto text-uppercase"
                            id="code"
                        ></b-form-input>
                    </b-form-group>
                </div>
                <div class="col-md-6">
                    <b-form-group
                        id="libelle"
                        label-cols-sm="4"
                        label-cols-lg="3"
                        description="Classe etudiant"
                        label="Classe"
                        label-for="input-horizontal"
                    >
                        <b-form-select
                            class="text-uppercase"
                            :options="dataClasse"
                            value-field="code"
                            text-field="libelle"
                            v-model.trim="formData.codecl"
                        ></b-form-select>
                    </b-form-group>
                </div>
            </div>
            <div class="row justify-content-end">
                <b-button variant="success mr-3" type="submit"
                >enregistrer
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
        this.chargerClasse()
    },
    data () {
        return {
            elementTY: {},
            dataClasse:[],
            title: 'Mise à jour Classe',
            formData: {
                matricule: '',
                nom: '',
                prenoms:'',
                contact:'',
                email:'',
                codecl:''
            },
            isloading: false
        }
    },
    methods: {
        showModal() {
            if (this.editMode === true) {
                this.formData.matricule = this.selectedTA.matricule
                this.formData.nom = this.selectedTA.nom
                this.formData.prenoms = this.selectedTA.prenoms
                this.formData.contact = this.selectedTA.contact
                this.formData.email = this.selectedTA.email
                this.formData.codecl = this.selectedTA.codecl
            } else {
                this.formData.matricule = null
                this.formData.nom = null
                this.formData.prenoms = null
                this.formData.contact = null
                this.formData.email = null
                this.formData.codecl = null
            }
            this.$refs['my-modal'].show()
        },
        closeModal () {
            this.$refs['my-modal'].hide()
        },
        async chargerClasse(){
            let urlapi = 'http://127.0.0.1:8000/api/classe';
            await this.axios.get(urlapi).then(response=>{
                this.dataClasse = response.data.listes_classes;
            }).catch((err) => {
                throw err
            })
        },
        async save(){
            if (this.editMode === true){
                this.$Progress.start()
                let  statut;
                let urlapi =  `http://127.0.0.1:8000/api/etudiant/${this.selectedTA.matricule}`;
                await this.axios.put(urlapi,this.formData) .then(response=>{
                    statut = response.data.status_code;

                    if (statut == 200){

                        Fire.$emit('creationok'); //custom events

                        Toast.fire({
                            icon: 'success',
                            title: 'Etudiant modifié avec succes'
                        })

                        this.$Progress.finish()

                        this.closeModal()

                    }else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Erreur lors de la modification'
                        })
                        this.$Progress.finish()
                        this.closeModal()
                    }
                }).catch((err) => {
                    throw err
                })
            }else {
                this.$Progress.start()
                let  statut;
                let urlapi = 'http://127.0.0.1:8000/api/etudiant';
                await this.axios.post(urlapi,this.formData)
                    .then(response=>{
                        statut = response.data.status_code;

                        if (statut == 200){

                            Fire.$emit('creationok'); //custom events

                            Toast.fire({
                                icon: 'success',
                                title: 'Etudiant crée avec succes'
                            })

                            this.$Progress.finish()

                            this.closeModal()

                        }else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Erreur  lors de la creation'
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
}
</script>

<style scoped>

</style>
