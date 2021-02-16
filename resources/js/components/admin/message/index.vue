<template>
    <div class="container-fluid p-3">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <b-breadcrumb>
                <b-breadcrumb-item>Gestion</b-breadcrumb-item>
                <b-breadcrumb-item>Des Messages</b-breadcrumb-item>
            </b-breadcrumb>
            <b-button variant="primary" @click="openModal"
            >Envoyer un nouveau message
            </b-button
            >
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                Message
            </div>
            <div class="card-body">
                <b-table
                    show-empty
                    head-variant="light"
                    bordered
                    hover
                    responsive="xl"
                    :busy="isLoading"
                    :items="dataMessage"
                    :fields="fields"
                >
                    <template v-slot:table-busy>
                        <div class="text-center text-primary my-2">
                            <b-spinner class="align-middle"></b-spinner>
                            <strong>Chargement...</strong>
                        </div>
                    </template>
                    <template v-slot:cell(message_etudiant)="row">
                        {{row.item.message_etudiant.nom}} {{row.item.message_etudiant.prenoms}}
                    </template>
                    <template v-slot:cell(type_message)="row">
                        <span
                            v-if="row.item.type_message === 1"
                            class="badge badge-danger rounded-0"
                        >EMAIL</span
                        >
                        <span v-else class="badge badge-success rounded-0"
                        >SMS</span
                        >
                    </template>
                    <template slot="code" slot-scope="data">
                        {{ data.item.code | truncate(30) }}
                    </template>


                </b-table>
                <b-pagination
                    :total-rows="totalRows"
                    :per-page="perPage"
                    v-model="currentPage"
                    class="my-0 pagination-sm"
                />
            </div>
        </div>
        <Form ref="modal"></Form>
    </div>
</template>

<script>
import Form from './form.vue'
export default {
    name: "index",
    data () {
        return {
            dataMessage: [],
            isLoading: false,
            currentPage: 1,
            perPage: 10,
            totalRows: null,
            selectedCode: null,
            fields: [
                {
                    key: 'objet',
                    sortable: true
                },
                {
                    key: 'message',
                    sortable: true
                },
                {
                    key: 'type_message',
                    sortable: true
                },
                {
                    key: 'message_etudiant',
                    label:'Destinataire',
                    sortable: true
                }
            ]
        }
    },
    components: {
        Form
    },
    methods: {
        openModal() {
            this.$refs.modal.editMode = false
            this.$refs.modal.showModal()
        },
        async getMessage(){
            let urlapi = 'http://127.0.0.1:8000/api/message';
            await this.axios.get(urlapi).then(response=>{
                this.dataMessage = response.data.listes.data;
                console.log(this.dataMessage)
            }).catch((err) => {
                throw err
            })
        },

    },
    created() {
        this.getMessage();
        Fire.$on('creationok',()=>{
            this.getMessage();
        })
    }
}
</script>

<style scoped>

</style>
