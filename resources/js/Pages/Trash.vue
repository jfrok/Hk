<script setup>
import {Head, router, useForm} from '@inertiajs/vue3';
import {Link} from "@inertiajs/vue3";
import moment from 'moment';
import {allPids} from "@/Pages/allPids";
import {watch} from "vue";
import Loader from "@/Components/Loader.vue";
import { ref } from 'vue';

let props = defineProps({
    trashed: Array,

})

const showSpinner = ref(false);

function alert(mesg) {
    toastr.success(mesg)
}
function warning(mesg) {
    toastr.warning(mesg)
}
function error(mesg) {
    toastr.error(mesg)
}
const destroy = (pId) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route('forceDelete',pId))
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}
const restore = (pId) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to restore this project!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, restore it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.post(route('restore',pId))
            Swal.fire(
                'Restore!',
                'Your file has been restored.',
                'success'
            )
        }
    })
}

function selectAll() {
    if ($('#checkAll').is(':checked')) {

        $('.form-check-input').prop('checked',true)

    } else {
        $('.form-check-input').prop('checked',false)
    }
    console.log(allPids)
}

let groupDeleteForm = useForm({
    pIds:[],
    checkIfAllSelected:'',

})
watch( () => allPids,($allPids) =>{
    console.log($allPids.value)
    groupDeleteForm.allpIds = $allPids.value
})
const groupDelete = () => {
    showSpinner.value = true;
    groupDeleteForm.post(route('trash.groupDelete'), {
        onStart: () => {
            showSpinner.value = true;
        },
        onFinish: () => {
            showSpinner.value = false;
        },
    });
};

</script>
<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    layout:AuthenticatedLayout,
}
</script>
<template>
<!--    <AuthenticatedLayout>-->
    <Head title="Projects"/>
    <div class="row">
        <div class="col-sm-12">
            <Loader :show="showSpinner" color="blue"  />

            <div v-if="$page.props.ziggy.flash.message">
                {{ alert($page.props.ziggy.flash.message) }}
            </div>
            <div v-if="$page.props.ziggy.flash.warning">
                {{ warning($page.props.ziggy.flash.warning) }}
            </div>
            <div v-if="$page.props.ziggy.flash.error">
                {{ error($page.props.ziggy.flash.error) }}
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-2">Trash</h5>
                </div>

                <div class="card-body" v-if="trashed.length > 0">
                    <div class="table-responsive">

                        <form @submit.prevent="groupDelete">

                        <table class="datatable table table-stripped">
                            <thead>
                            <tr>
                                <th>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" @change="selectAll" id="checkAll" v-model="groupDeleteForm.checkIfAllSelected" type="checkbox">
                                    </div>
                                </th>
                                <th>Title</th>
<!--                                <th>Description</th>-->
<!--                                <th>Image path</th>-->
                                <th>View</th>
                                <th>Restore</th>
                                <th>Delete</th>
                                <th>Delete at</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr  v-for="project in trashed"
                                 :key="project.id">
                                <td>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" id="allIds" name="pIds[]" v-model="groupDeleteForm.pIds"  type="checkbox" :value="project.id">
                                        <input class="form-check-input" name="allIds[]" v-model="groupDeleteForm.pIds"  type="hidden">
                                    </div>

                                </td>
                                <td>{{project.title}}</td>
<!--                                <td>{{project.description}}</td>-->
<!--                                <td>{{ project.path }}</td>-->
                                <td>
                                    <div class="up-come-headerS">   <Link :href="route('content.index',project.id)"><span><i class="feather-eye"></i></span></Link></div></td>
                                <td>  <div class="up-come-headerS">   <Link  @click="restore(project.id)"><span><i class="feather-refresh-ccw"></i></span></Link></div></td>
                                <td><div class="up-come-headerS"><a type="button" @click="destroy(project.id)"><span><i class="feather-trash"></i></span></a></div></td>
                                <td>{{moment(project.deleted_at).format('DD/MM/YYYY')}}</td>
                            </tr>
<!--                            <td v-if="trashed == null">-->
<!--                                No information founded-->
<!--                            </td>-->
                            </tbody>
                        </table>
                            <button class="btn btn-danger mt-5" type="submit" v-if="trashed.length > 1"><span><i
                            class="feather-trash-2"></i></span></button>
                        </form>
                    </div>
                </div>
                <div v-else>
                    <v-alert
                        type="info"
                        title="No data founded"
                        text="There are is no data"
                        variant="tonal"
                    ></v-alert>
                </div>
            </div>

        </div>
    </div>
<!--    </AuthenticatedLayout>-->
</template>
