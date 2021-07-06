<template>
    <div class="page-wrapper user-color">
        <slot name="header"></slot>
        <!-- Navbar top Start-->
        <div class="container-fluid user-bg-title">
            <div class="user-serchbox d-flex">
                <div class="user-title capi">
                    <h2>Categories List</h2>

                </div>
                <div class="searchbox ml-auto">
                    <nav class="navbar user-nav d-flex nav-mr-top">
                        <form class="form-inline">
                            <div class="form-group">
                                <select class="select_style form-control select"   v-model="query.search_type">
                                    <option v-for="row in filter_types" :key="row.key_value" :value="row.key_value">{{row.key_name}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control mr-sm-2"  v-model="query.search_text" type="search" placeholder="Enter your text" aria-label="Search">
                            </div>

                            <button @click="getData()" class="btn btn-outline-success my-2 my-sm-0 mr-4 ml-3" type="button">Search</button>
                        </form>
                        <a :href="route(link)" :active="route().current(link)" class="btn btn-primary btn-sm cls rg-top-btn"><i class="fa fa-plus"></i>Create</a>

                    </nav>

                </div>
            </div>
        </div>


        <nav aria-label="Page breadcrumb">
            <ol class="breadcrumb padding-top">
                <li class="breadcrumb-item" aria-current="page">Main</li>
                <li class="breadcrumb-item" aria-current="page">Main</li>


            </ol>
        </nav>

        <div class="col-md-12">
            <div class="table-responsive">
                <form action="">
                    <div class="col-sm-12 date_root">
                        <label class="date_export bold" for="" >Export: </label>

                        <button style="float: right;"  @click="getDateData()"  class="btn btn-data my-2 my-sm-0 mr-4 ml-3" type="button" >Go</button>

                        <div class="date_sub" style="">
                            <input name="to_date" v-model="dateQuery.to_date"  class="select_style" type="date" id="example-date-input">
                        </div>
                        <label class="date_lavel" for="example-date-input">To </label>

                        <div class="date_sub" >
                            <input nmae="from_date"  v-model="dateQuery.from_date" class="select_style" type="date">
                        </div>
                        <label class="date_lavel"   >From </label>
                    </div>
                </form>
                <table class="table table-border table-striped custom-table datatable mb-0">
                    <thead>
                    <tr class="bg-white">
                        <th>#</th>
                        <th>Category Name</th>
                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(row,index) in data['data'].data" :key="row.id">
                        <td>{{index+1}}</td>
                        <td>{{row.name}}</td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action ">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right " x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-91px, 27px, 0px);">
                                    <a class="dropdown-item" :href="route('categories.show', [row.id])" ><i class="fa fa-pencil m-r-5"></i> View</a>
                                    <button @click="getDelete(row.id)"  class="dropdown-item"  data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!--                Pagination Start-->
        <div class="container-fluid d-flex">
            <nav aria-label="Page navigation example mr-auto">
                <ul class="pagination  pagi-color">
                    <li >
                        <a  href="#" tabindex="-1">Showing</a>
                    </li>
                    <li ><a  href="#">{{ data['data'].to }} to</a></li>
                    <li ><a  href="#">{{ data['data'].total }} of</a></li>
                    <li >
                        <a  href="#">entries</a>
                    </li>
                </ul>
            </nav>
            <nav aria-label="Page navigation example pagi-relation">
                <ul class="pagination ft">
                    <li class="page-item"  v-for="row in data['data'].links" :key="row.label"  v-bind:class="row.active ? ' pg' : 'p-i'">
                        <a :href="row.url"><span v-html="row.label"></span></a>
                    </li>
                </ul>
            </nav>
        </div>
        <!--                Pagination end-->


    </div>
</template>

<script>



export default {
    components: {

    },

    props: ['data', 'errors','createMode','viewMode', 'editMode', 'link', 'title', 'label'],
    data () {
        return {
            myValue: '',
            myOptions:[{id: null, text: ''}],
            mailOptions:[
                {id: 'html', text: 'html'},
                {id: 'css', text: 'css'},
            ],
            photo: null,
            filter_types: [
                {'key_value': '', 'key_name': 'All'},
                {'key_value': 'name', 'key_name': 'Name'},
            ],
            query: {
                search_type: '',
                search_text: ''
            },
            dateQuery:{
                from_date: '',
                to_date: '',
            },
            form: {
                index:'',
                id: undefined,
                name:null

            }
        }
    },
    created () {

    },
    methods: {
        getData: function () {
            this.$inertia.get('/categories/index', this.query)
        },
        getDateData: function () {
            this.$inertia.get('/categories/index', this.dateQuery)
        },
        save(params){

            this.$inertia.post('/categories/store', params);
        },
        getDelete(id){
            this.$inertia.get('/categories/'+id+'/delete');

        }
    }
}
</script>
