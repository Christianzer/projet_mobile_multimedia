<template>
    <b-modal ref="my-modal" size="lg" :hide-footer="true" :title="title">
        <form  @submit.prevent="save">
            <div class="row">
                <div v-if="editMode == false" class="col-md-6">
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
                            class="w-auto"
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
                            class="w-auto"
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
            this.$Progress.start()
            let  statut;
            let urlapi = 'http://projet_mobile.test/api/classe';
            await this.axios.post(urlapi,this.formData)
                .then(response=>{
                    statut = response.data.status_code;
                    if (statut == 200){

                        Fire.$emit('creationok'); //custom events

                        Toast.fire({
                            icon: 'success',
                            title: 'Classe cree avec succes'
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
</script>

<style scoped>

</style>
