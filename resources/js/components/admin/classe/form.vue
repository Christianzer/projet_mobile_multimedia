<template>
    <b-modal ref="my-modal" size="lg" :hide-footer="true" :title="title">
        <form  @submit.prevent="save">
            <div class="row">
                <div class="col-md-6">
                    <b-form-group
                        id="code"
                        label-cols-sm="4"
                        label-cols-lg="3"
                        description="code unique"
                        label="code"
                        label-for="input-horizontal"
                    >
                        <b-form-input
                            v-model.trim="formData.code"
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
                        description="description"
                        label="Libellé"
                        label-for="input-horizontal"
                    >
                        <b-form-input
                            class="w-auto text-uppercase"
                            type="text"
                            v-model.trim="formData.libelle"
                        ></b-form-input>
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
    data () {
        return {
            elementTY: {},
            title: 'Mise à jour Classe',
            formData: {
                code: '',
                libelle: ''
            },
            isloading: false
        }
    },
    methods: {
        showModal() {
            if (this.editMode === true) {
                this.formData.code = this.selectedTA.code
                this.formData.libelle = this.selectedTA.libelle
            } else {
                this.formData.code = null
                this.formData.libelle = null
            }
            this.$refs['my-modal'].show()
        },
        closeModal () {
            this.$refs['my-modal'].hide()
        },
        async save(){
            if (this.editMode === true){
                this.$Progress.start()
                let  statut;
                let urlapi =  `http://127.0.0.1:8000/api/classe/${this.selectedTA.code}`;
                await this.axios.put(urlapi,this.formData) .then(response=>{
                    statut = response.data.status_code;

                    if (statut == 200){

                        Fire.$emit('creationok'); //custom events

                        Toast.fire({
                            icon: 'success',
                            title: 'Classe modifié avec succes'
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
                let urlapi = 'http://127.0.0.1:8000/api/classe';
                await this.axios.post(urlapi,this.formData)
                    .then(response=>{
                        statut = response.data.status_code;

                        if (statut == 200){

                            Fire.$emit('creationok'); //custom events

                            Toast.fire({
                                icon: 'success',
                                title: 'Classe crée avec succes'
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
