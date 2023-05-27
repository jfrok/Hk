<script setup>
import {Head, router} from '@inertiajs/vue3';
import {Link} from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

let props = defineProps({
    projects: Object,

})
function alert(mesg) {
    toastr.success(mesg)
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
            router.post(route('project.delete',pId))
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}
</script>

<template>
    <Head title="Projects"/>
        <div class="row">
            <div class="col-sm-12">
<div v-if="$page.props.ziggy.flash.message">
    {{ alert($page.props.ziggy.flash.message) }}
</div>


                <div class="card">
                    <div class="card-header">
<!--                        <h5 class="card-title mb-2">Projects</h5>-->
<!--                        <p class="card-text">-->
<!--                            This is the most basic example of the datatables with zero configuration. Use the <code>.datatable</code>-->
<!--                            class to initialize datatables.-->
<!--                        </p>-->
                        <div class="up-come-header">
                            <h2>Upcoming Projects</h2>
                            <span><Link :href="route('project.add',$page.props.auth.user.id)"><i class="feather-plus"></i></Link></span>
                        </div>
                    </div>
                    <v-alert v-if="projects.data.length < 1"
                             type="info"
                             title="No data founded"
                             text="There are is no data"
                             variant="tonal"
                    ></v-alert>
                    <div class="card-body" v-else>
                        <div class="table-responsive">

                            <table class="datatable table table-stripped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image path</th>
                                    <th>View</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr  v-for="project in projects.data"
                                     :key="project.id">
                                    <td>{{project.title}}</td>
                                    <td>{{project.description}}</td>
                                    <td>{{ project.path }}</td>
                                    <td>
                                        <div class="up-come-headerS">   <Link :href="route('content.index',project.id)"><span><i class="feather-eye"></i></span></Link></div></td>
                                    <td><div class="up-come-headerS"><a type="button" @click="destroy(project.id)"><span><i class="feather-trash"></i></span></a></div></td>
                                </tr>
                                </tbody>
                            </table>
                            <div v-if="projects.data.length > 1">
                            <Pagination :links="projects.links"/>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
        </div>
</template>
<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

export default {
    layout:AuthenticatedLayout
}


</script>
