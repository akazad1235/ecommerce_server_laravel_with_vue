<template>
    <div class="page-wrapper user-color">
        <slot name="header"></slot>
        <!-- Navbar top Start-->
        <div class="container-fluid user-bg-title">
            <div class="user-serchbox d-flex">
                <div class="user-title capi">
                    <h2 >dsfsdfsdf</h2>

                </div>
                <div class="searchbox ml-auto">
                    <nav class="navbar user-nav d-flex nav-mr-top">
                        <a class="btn btn-primary btn-sm cls rg-top-btn"><i class="fa fa-angle-left"></i> Mail Settings</a>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar top End-->
        <!-- Navbar top End-->

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

                        <button style="float: right;"  class="btn btn-data my-2 my-sm-0 mr-4 ml-3" type="button" >Go</button>

                        <div class="date_sub" style="">
                            <input name="to_date"  class="select_style" type="date" id="example-date-input">
                        </div>
                        <label class="date_lavel" for="example-date-input" >To </label>

                        <div class="date_sub" >
                            <input nmae="from_date"  class="select_style" type="date">
                        </div>
                        <label class="date_lavel"  for="" >From </label>
                    </div>
                </form>
                <table class="table table-border table-striped custom-table datatable mb-0">
                    <thead>
                    <tr class="bg-white">
                        <th>#</th>
                        <th>Protocol</th>

                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(row,index) in data['data'].data" :key="row.id">
                        <td>1</td>
                        <td>wwww</td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action ">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right " x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-91px, 27px, 0px);">
                                    <a class="dropdown-item" ><i class="fa fa-pencil m-r-5"></i> View</a>
                                    <button   class="dropdown-item"  data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


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
            form: {
                index:'',
                id: undefined,
                name:null

            }
        }
    },
    created () {
        alert('ok');
    },
    methods: {
        save(params){

            this.$inertia.post('/categories/store', params);

        }
    }
}
</script>
