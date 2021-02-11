<template>
    <div class="container-fluid p-3">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <b-breadcrumb>
                <b-breadcrumb-item>Gestion</b-breadcrumb-item>
                <b-breadcrumb-item>Classe</b-breadcrumb-item>
            </b-breadcrumb>
            <b-button variant="primary" @click="openModal"
            >Créer une nouvelle classe
            </b-button
            >
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                Classe
            </div>
            <div class="card-body">
                <b-table
                    show-empty
                    head-variant="light"
                    bordered
                    hover
                    :busy="isLoading"
                    :items="dataClasse"
                    :fields="fields"
                >
                    <template v-slot:table-busy>
                        <div class="text-center text-primary my-2">
                            <b-spinner class="align-middle"></b-spinner>
                            <strong>Chargement...</strong>
                        </div>
                    </template>

                    <template slot="code" slot-scope="data">
                        {{ data.item.code | truncate(30) }}
                    </template>


                    <template v-slot:cell(activer)="row">
                        <span
                            v-if="row.item.activer === 0"
                            class="badge badge-danger rounded-0"
                        >NON</span
                        >
                        <span v-else class="badge badge-success rounded-0"
                        >OUI</span
                        >
                    </template>

                    <template v-slot:cell(actions)="row">
                        <b-button
                            size="sm"
                            variant="outline-primary"
                            @click="modifier(row.item)"
                        >
                            modifier
                        </b-button>

                        <b-button
                            size="sm"
                            variant="outline-danger"
                            class="mr-1"
                            @click="supprimer(row.item.code)"
                        >
                            supprimer
                        </b-button>
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
            dataClasse: [],
            testclas:[],
            isLoading: false,
            currentPage: 1,
            perPage: 10,
            totalRows: null,
            selectedCode: null,
            fields: [
                {
                    key: 'code',
                    sortable: true
                },
                {
                    key: 'libelle',
                    sortable: true
                },
                {
                    key: 'actions'
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
        async getClasses(){
            let urlapi = 'http://projet_mobile.test/api/classe';
            await this.axios.get(urlapi).then(response=>{
                this.dataClasse = response.data.listes_classes;
            }).catch((err) => {
                throw err
            })
        },
    },
    created() {
        this.getClasses();
        Fire.$emit('creationok',()=>{
            this.getClasses();
        })
    }
}
</script>

<style scoped>

</style>
