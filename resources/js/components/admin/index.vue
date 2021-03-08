<template>
    <div class="container-fluid p-3">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <b-breadcrumb>
                <b-breadcrumb-item>Admin</b-breadcrumb-item>
                <b-breadcrumb-item>Tableau de bord</b-breadcrumb-item>
            </b-breadcrumb>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">NOMBRES D'ETUDIANT</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{nbreet}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">NOMBRE DE CLASSE</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{nbreclasse}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">NOMBRES DE MESSAGE ENVOYE</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{nbreMessageSend}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-secondary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">NOMBRES DE MESSAGE RECU</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{nbreMesseRes}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "index",
    data(){
        return {
            nbreet : null,
            nbreclasse:null,
            nbreMessageSend:null,
            nbreMesseRes:null
        }
    },
    methods:{
        async getElement(){
            let urlapi = 'http://127.0.0.1:8000/api/getsp';
            await this.axios.get(urlapi).then(response=>{
                this.nbreet = response.data.nbreet;
                this.nbreclasse = response.data.nbreclass;
                this.nbreMessageSend = response.data.messagsend;
                this.nbreMesseRes = response.data.messrecu;
            }).catch((err) => {
                throw err
            })
        }
    },
    created() {
        this.getElement()
    }
}
</script>

<style scoped>

</style>
