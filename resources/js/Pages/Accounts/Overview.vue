<template>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">

                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Fees Collections</h3>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="#" class="btn btn-outline-primary me-2"><i class="fas fa-download"></i> Download</a>
                                <a href="add-fees-collection.html" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <thead class="student-thread">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Lang</th>
                                <th>Amount</th>
                                <th>Paid Date</th>
                                <th class="text-end">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users" :key="user.id">
                                <td>{{user.name}}</td>
                                <td>
                                    <h2 class="table-avatar">
                                        <a class="avatar avatar-sm me-2">
                                            <img class="avatar-img rounded-circle" v-if="$page.props.auth.user.avatar"
                                                                              :src="$page.props.auth.user.avatar" alt="User Image">
                                            <img v-else src="https://i.postimg.cc/fLHg7Wx1/system2.webp" alt="">
                                        </a>

                                        <a>Aaliyah</a>
                                    </h2>
                                </td>
                                <td>Female</td>
                                <td>Mess Fees</td>
                                <td>$120</td>
                                <td>17 Aug 2020</td>
                                <td class="text-end">
                                    <span class="badge badge-success">Paid</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import DataTable from "@/Components/DataTable.vue";

export default {
    components: {DataTable},
    layout: AuthenticatedLayout,
props:{
        users:Array
}
}
</script>
