<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head, router, useForm} from "@inertiajs/vue3";
import {Link} from "@inertiajs/vue3";
import draggable from "vuedraggable";
import format from "@popperjs/core/lib/utils/format";
import EditContentModal from "@/Components/EditContentModal.vue";

function alert(mesg) {
    toastr.success(mesg)
}
function alertError(mesg) {
    toastr.error(mesg)
}
export default {
    layout: AuthenticatedLayout,
    props: {
        // show: Array,
        // contents: Array,
    },
    components: {EditContentModal, Head, Link,draggable},
    methods: {
    //     handleChange() {
    //         console.log('changed');
    //     },
    //     inputChanged(value) {
    //         this.activeNames = value;
    //     },
    //     getComponentData() {
    //         return {
    //             on: {
    //                 change: this.handleChange,
    //                 input: this.inputChanged
    //             },
    //             attrs:{
    //                 wrap: true
    //             },
    //             props: {
    //                 value: this.activeNames
    //             }
    //         };
    //     }
     }
}

</script>
<template>
    <Head title="Show"/>
    <div v-if="$page.props.ziggy.flash.message">
        {{ alert($page.props.ziggy.flash.message) }}
    </div>
    <div v-if="$page.props.ziggy.flash.error">
        {{ alertError($page.props.ziggy.flash.error) }}
    </div>
    <div class="content container-fluid">


        <div class="blog-view">
            <div class="blog-single-post">
                <a href="blog.html" class="back-btn"><i class="feather-chevron-left"></i> Back</a>
                <div class="blog-image">
                    <a href="javascript:void(0);"><img alt=""
                                                       :src="show.path"
                                                       class="img-fluid"></a>
                </div>
            </div>
        </div>

<!--        <draggable tag="el-collapse" :list="list" :component-data="getComponentData()">-->
<!--            <el-collapse-item v-for="e in list" :title="e.title" :name="e.name" :key="e.name">-->
<!--                <div>{{e.description}}</div>-->
<!--            </el-collapse-item>-->
<!--        </draggable>-->
        <div class="student-group-form">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by ID ...">
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Name ...">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search by Class ...">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="search-student-btn">
                        <button type="btn" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">

                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Content</h3>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <Link :href="route('content.addFoto',show.id)" class="btn btn-outline-primary me-2">
                                        <i class="fas fa-image"></i></Link>
                                    <Link :href="route('content.add',show.id)" class="btn btn-primary"><i
                                        class="fas fa-plus"></i></Link>
                                </div>
                            </div>
                        </div>
                        <!--                        <EditContentModal/>-->
<!--                        <div id="EditContentmodal" class="modal fade" role="dialog" aria-labelledby="myModalLabel"-->
<!--                             aria-hidden="true">-->
<!--                            <div class="modal-dialog">-->
<!--                                <div class="modal-content">-->
<!--                                    <div class="modal-header">-->
<!--                                        <h4 class="modal-title">Edit Content</h4>-->
<!--                                        <button type="button" class="btn-close" data-bs-dismiss="modal"-->
<!--                                                aria-label="Close"></button>-->
<!--                                    </div>-->
<!--                                    <form method="post" @submit.prevent="save" id="editContentFrom">-->
<!--                                        <div class="modal-body p-4">-->
<!--                                            <div class="row">-->
<!--                                                <div class="col-md-12">-->
<!--                                                    <div class="mb-3">-->
<!--                                                        <label for="field-1" class="form-label">Title</label>-->
<!--                                                        <input type="hidden" name="cId" id="cId" class="form-control">-->
<!--                                                        <input type="text" v-model="form.title" name="title" id="title"-->
<!--                                                               class="form-control">-->
<!--                                                    </div>-->
<!--                                                </div>-->

<!--                                            </div>-->

<!--                                            <div class="row">-->
<!--                                                <div class="col-md-12">-->
<!--                                                    <div class="mb-3">-->
<!--                                                        <label for="field-4" class="form-label">Date from</label>-->
<!--                                                        <textarea v-model="form.description" name="description"-->
<!--                                                                  id="description" class="form-control"></textarea>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            &lt;!&ndash;                    <div class="row">&ndash;&gt;-->
<!--                                            &lt;!&ndash;                        <div class="col-md-12">&ndash;&gt;-->
<!--                                            &lt;!&ndash;                            <div class="">&ndash;&gt;-->
<!--                                            &lt;!&ndash;                                <label for="field-7" class="form-label">Personal Info</label>&ndash;&gt;-->
<!--                                            &lt;!&ndash;                                <textarea class="form-control" id="field-7" placeholder="Write something about yourself"></textarea>&ndash;&gt;-->
<!--                                            &lt;!&ndash;                            </div>&ndash;&gt;-->
<!--                                            &lt;!&ndash;                        </div>&ndash;&gt;-->
<!--                                            &lt;!&ndash;                    </div>&ndash;&gt;-->
<!--                                        </div>-->
<!--                                        <div class="modal-footer">-->
<!--                                            <button type="button" class="btn btn-secondary waves-effect"-->
<!--                                                    data-bs-dismiss="modal">Close-->
<!--                                            </button>-->
<!--                                            <button type="submit" class="btn btn-info waves-effect waves-light">Save-->
<!--                                                changes-->
<!--                                            </button>-->
<!--                                        </div>-->
<!--                                    </form>-->
<!--                                </div>-->

<!--                            </div>-->
<!--                        </div>-->

                        <!--                        <EditContentModal/>-->
                        <div class="table-responsive">
<!--                            <form @submit.prevent="groupDelete">-->

                            <table
                                class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                <thead class="student-thread blue-background-class">
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" v-model="groupDeleteForm.checkIfAllSelected" @change="selectAll" id="checkAll" type="checkbox">                                        </div>
                                    </th>
                                    <th>Type</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Path</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>

                                <tbody id="sortable" >

                                <tr v-for="content in contents"
                                    :key="content.id"  >

                                    <td>
                                        <input type="hidden" id="contentIds" name="contentIds[]" :value="content.id">
                                        <div class="form-check check-tables">
<!--                                            <input class="form-check-input" id="cIds" name="cIds" v-model="groupDeleteForm.cIds"  type="checkbox" :value="content.id" @change="event => updateSelectedContentIds(event.target.checked, content.id)">                                        </div>-->
                                            <input class="form-check-input" id="cIds" name="cIds"   v-model="groupDeleteForm.selectedContentIds" type="checkbox" :value="content.id" @change="event => updateSelectedContentIds(event.target.checked, content.id)">
<!--                                            <input type="text" v-model="groupDeleteForm.allContentIds">-->
                                        </div>
                                    </td>
                                    <td>{{ content.type }}</td>
                                    <td>{{ content.title }}</td>
                                    <td>
                                        <h2>
                                            <a>{{ content.description }}</a>
                                        </h2>
                                    </td>
                                    <td>{{content.path}}</td>
                                    <td class="text-end">
                                        <div class="actions">
                                            <!--                                            <a href="javascript:;" class="btn btn-sm bg-success-light me-2">-->
                                            <!--                                                <i class="feather-eye"></i>-->
                                            <!--                                            </a>-->
                                            <Link :href="route('content.edit',content.id)"
                                                  class="btn btn-sm bg-danger-light">
                                                <i class="feather-edit"></i>
                                            </Link>
                                            <div class="up-come-headerS"><a class="btn btn-sm bg-danger-light"
                                                                            type="button"
                                                                            @click="destroy(content.id)"><span><i
                                                class="feather-trash"></i></span></a></div>

                                        </div>
                                    </td>
                                </tr>

                                </tbody>

                            </table>
                                <button v-if="contents.length > 1" class="btn btn-danger mt-5" @click="groupDelete"><span><i
                                    class="feather-trash-2"></i></span></button>

<!--                            </form>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

</template>
<script setup>
import {router, useForm} from "@inertiajs/vue3";
import {allCids} from "@/Pages/Content/allCids";
let props = defineProps({
    show:Array,
    contents: Array,
})
function openEditModal() {
    //do something here
    console.log('test');
    $('#EditContentmodal').modal('show')
}
// var el = document.getElementById('item');
// var sortable = Sortable.create(el);

// $(function (e){
//     $('#checkAll').on('change',function (){
//         $('.form-check-input').prop('checked',$(this)).prop('checked')
//         let allCids = []
//         $('input:checkbox[name=cIds]:checked').each(function (){
//             allCids.push($(this).val())
//         })
//         console.log(allCids)
//
//     })
// })
// let saveContent = () => {
//     form.post(route('content.edit',props.pId.id))
// }
// $('#editContentFrom').on('submit', function (e) {
//     const cId =  document.getElementById('cId').value
//     e.preventDefault();
//     let formData = new FormData(this);
//     $.ajaxSetup({
//     });
//
//     $.ajax({
//         url: "/projects/content/save-text/"+cId,
//         method: "POST",
//         contentType: false,
//         processData: false,
//         data: formData,
//         success: function (data) {
//            // $('#editMediaModal').modal('toggle')
//             console.log('succss')
//
//         }
//     })
// });
$( function() {
    $( "#sortable" ).sortable({
        placeholder: "ui-state-highlight",
        update: function () {
            let contentIds = [];
            $('input[name="contentIds[]"]').each(function () {
                contentIds.push($(this).val());
            });
            // Get request to save sort
            $.get('/projects/content/sort', {contentIds: contentIds});
        }
    });

});


// function selectAll() {
//     if ($('#checkAll').is(':checked')) {
//         $('.form-check-input').each(function (){
//             $(this).prop('checked', true);
//             if (!allCids.value.includes(parseInt($(this).val()))) {
//                 allCids.value.push(parseInt($(this).val()));
//             }
//         });
//         console.log(allCids.value);
//     } else {
//         $('.form-check-input').each(function (){
//             $(this).prop('checked', false);
//         });
//         allCids.value = [];
//         console.log(allCids.value);
//     }
// }
// let form = useForm({
//     title: '',
//     description: '',
// })

let selectedContentIds = [];

function updateSelectedContentIds(checked, contentId) {
    if (checked) {
        selectedContentIds.push(contentId);
        console.log(selectedContentIds)
    } else {
        selectedContentIds = selectedContentIds.filter(id => id !== contentId);
    }
}

function selectAll(event) {
    const isChecked = event.target.checked;

    if (isChecked) {
        $('.form-check-input').each(function () {
            $(this).prop('checked', true);
            // const contentId = parseInt($(this).val());
            // if (!selectedContentIds.includes(contentId)) {
            //     selectedContentIds.push(contentId);
            // }
        });
    } else {
        $('.form-check-input').each(function () {
            $(this).prop('checked', false);
        });
        // selectedContentIds = [];
    }
   // console.log(selectedContentIds);
}

// function groupDelete() {
//     // استخدم selectedContentIds هنا للحذف
//     console.log(selectedContentIds);
// }
let save = () => {

    const cId = document.getElementById('cId').value

    form.post(route('content.save', cId),{
        preserveScroll: true
    })
    // $('#EditContentmodal').modal('show');
}
let groupDeleteForm = useForm({

    checkIfAllSelected: Boolean,
     pId: props.show.id,
    selectedContentIds: selectedContentIds,
});

let groupDelete = () => {
    groupDeleteForm.post(route('content.groupDelete'),{
        preserveScroll: true
    })
}

const destroy = (cId) => {
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
            router.post(route('content.delete', cId))
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
    })
}
</script>
