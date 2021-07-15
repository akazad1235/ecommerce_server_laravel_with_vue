<template>
    <form class="ml-3">
        <div class="row">
            <div class="col-md-10 card-box">
                <h6 class="my-2">Product Images</h6>
                <div class="form-group">
                    <label for="img1">Image One<span class="text-red">*</span></label>
                    <input type="file" class="form-control"  id="img1"  ref="fileOne" v-on:change="handleFileUpload1()"/>
                    <div class="text-danger" v-if="errors.image">{{ errors.image}}</div>
                </div>
                <div class="form-group">
                    <label for="img2">Image One<span class="text-red">*</span></label>
                    <input type="file" class="form-control"  id="img2"  ref="fileTwo" v-on:change="handleFileUpload2()"/>
                    <div class="text-danger" v-if="errors.image">{{ errors.image}}</div>
                </div>
                <div class="form-group">
                    <label for="img3">Image One<span class="text-red">*</span></label>
                    <input type="file" class="form-control"  id="img3"  ref="fileThree" v-on:change="handleFileUpload3()"/>
                    <div class="text-danger" v-if="errors.image">{{ errors.image}}</div>
                </div>

            </div>

        </div>
        <div class="col-md-10 mb-5">
            <div class="m-t-10 text-center">
                <button
                    type="button"
                    class="form-submit-btn  pull-right  ml-10"
                    wire:click.prevent="store()"
                    @click="save(form, 'next')"
                >
                    Next
                </button>

                <button
                    style="background-color: #FF451A"
                    type="button"
                    class="form-submit-btn  ml-10  pull-right "
                    wire:click.prevent="store()"
                    @click="cancel()"
                >
                    Cancel
                </button>


            </div>
        </div>
    </form>


</template>

<script>
import Alert from "@/Pages/Component/Alert";
import Header from "@/Pages/Component/Header";
import Select2 from 'vue3-select2-component';


export default {
    components: {
        Alert,
        Header,
        Select2


    },
    props: ['data','errors', 'createMode','viewMode', 'editMode', 'link', 'title', 'label'],
    data () {
        return {
            file1:null,
            file2:null,
            file3:null,
            form: {
                index:'',
                id: undefined,

            }
        }
    },
    created () {
        if(this.viewMode){
            this.form.name = this.data.name
        }
        if(this.editMode){
            this.form.name=this.data.name
        }
    },
    methods: {

        save(params){
            var data = new FormData()
            data.append('image_one', this.file1 || '')
            data.append('image_two', this.file2 || '')
            data.append('image_three', this.file3 || '')
            this.$inertia.post(`/products/${this.data.slug}/images/store`, data);
        },
        save_create(params){
            params['create_another'] = 1;
            this.$inertia.post('/categories/store', params);
            this.form ={}
        },
        Edit(){
            this.$inertia.get('/categories/'+this.data.id+'/edit');

        },
        update(params){
            this.$inertia.post('/categories/'+this.data.id+'/update', params);
        },
        handleFileUpload1(){
            alert('one');
            this.file1 = this.$refs.fileOne.files[0];
        },
        handleFileUpload2(){
            alert('two');
            this.file2 = this.$refs.fileTwo.files[0];
        },
        handleFileUpload3(){
            alert('three');
            this.file3= this.$refs.fileThree.files[0];
        }


    }
}
</script>
<style>

</style>
