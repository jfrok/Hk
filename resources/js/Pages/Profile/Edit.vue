<template>
    <Head title="Profile"/>

    <div class="row">
        <div class="col-md-12">
            <div class="profile-header">
                <div class="row align-items-center">
                    <div class="col-auto profile-image">
                        <a href="#">
                            <img class="rounded-circle" alt="User Image"
                                 src="assets/img/profiles/avatar-02.jpg">
                        </a>
                    </div>
                    <div class="col ms-md-n2 profile-user-info">
                        <h4 class="user-name mb-0">{{ $page.props.auth.user.name }}</h4>
                        <h6 class="text-muted">{{ $page.props.auth.user.job }}</h6>
                        <div class="user-Location"><i class="fas fa-map-marker-alt"></i>
                            {{ $page.props.auth.user.city }}, {{ $page.props.auth.user.address }}
                        </div>
                        <div class="about-text">{{ $page.props.auth.user.description }}</div>
                    </div>
                    <!--                        <div class="col-auto profile-btn">-->
                    <!--                            <a href="" class="btn btn-primary">-->
                    <!--                                Edit-->
                    <!--                            </a>-->
                    <!--                        </div>-->
                </div>
            </div>
            <div class="profile-menu">
                <ul class="nav nav-tabs nav-tabs-solid">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content profile-tab-cont">

                <div class="tab-pane fade show active" id="per_details_tab">

                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>Personal Details</span>
<!--                                        <a class="edit-link" data-bs-toggle="modal"-->
<!--                                           href="#edit_personal_details"><i-->
<!--                                            class="far fa-edit me-1"></i>Edit</a>-->
                                    </h5>
                                    <div class="row">
                                        <UpdateProfileInformationForm
                                            :must-verify-email="mustVerifyEmail"
                                            :status="status"
                                            class="max-w-xl"
                                        />
                                    </div>
                                    <!--                                        <div class="row">-->
                                    <!--                                            <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>-->
                                    <!--                                            <p class="col-sm-9">305-310-5857</p>-->
                                    <!--                                        </div>-->
                                    <!--                                        <div class="row">-->
                                    <!--                                            <p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>-->
                                    <!--                                            <p class="col-sm-9 mb-0">4663 Agriculture Lane,<br>-->
                                    <!--                                                Miami,<br>-->
                                    <!--                                                Florida - 33165,<br>-->
                                    <!--                                                United States.</p>-->
                                    <!--                                        </div>-->
                                </div>
                            </div>
                        </div>

                        <div class="modal custom-modal fade bank-details" id="bank_details" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="form-header text-start mb-0">
                                            <h4 class="mb-0">Add Skill</h4>
                                        </div>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="bank-inner-details">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label>Add skill</label>
                                                        <input type="text" class="form-control" placeholder="Add Name">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6" v-for="i in numberOfInputs" :key="i">
                                                    <label>New skill</label>
                                                    <input type="text" class="form-control" placeholder="Add Name"/>
                                                </div>


                                                <!--                                                    <div class="col-lg-6 col-md-6">-->
                                                <!--                                                        <div class="form-group">-->
                                                <!--                                                            <label>Bank name</label>-->
                                                <!--                                                            <input type="text" class="form-control" placeholder="Add Bank name">-->
                                                <!--                                                        </div>-->
                                                <!--                                                    </div>-->
                                                <!--                                                    <div class="col-lg-6 col-md-6">-->
                                                <!--                                                        <div class="form-group">-->
                                                <!--                                                            <label>IFSC Code</label>-->
                                                <!--                                                            <input type="text" class="form-control">-->
                                                <!--                                                        </div>-->
                                                <!--                                                    </div>-->
                                                <!--                                                    <div class="col-lg-6 col-md-6">-->
                                                <!--                                                        <div class="form-group">-->
                                                <!--                                                            <label>Account Number</label>-->
                                                <!--                                                            <input type="text" class="form-control">-->
                                                <!--                                                        </div>-->
                                                <!--                                                    </div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="bank-details-btn">
                                            <a href="javascript:void(0);" data-bs-dismiss="modal"
                                               class="btn bank-cancel-btn me-2">Cancel</a>
                                            <a href="javascript:void(0);" class="btn bank-cancel-btn me-2"
                                               @click="addInput">Add input</a>
                                            <a href="javascript:void(0);" class="btn bank-save-btn">Save</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">

                            <!--                                <div class="card">-->
                            <!--                                    <div class="card-body">-->
                            <!--                                        <h5 class="card-title d-flex justify-content-between">-->
                            <!--                                            <span>Account Status</span>-->
                            <!--                                            <a class="edit-link" href="#"><i class="far fa-edit me-1"></i> Edit</a>-->
                            <!--                                        </h5>-->
                            <!--                                        <button class="btn btn-success" type="button"><i-->
                            <!--                                            class="fe fe-check-verified"></i> Active-->
                            <!--                                        </button>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->


                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-between">
                                        <span>Skills </span>

                                        <!--                                            <a class="edit-link" href="#"><i class="far fa-edit me-1"></i> Edit</a>-->

                                    </h5>
                                    <div style="margin-bottom: 55px">
                                        <Chip/>
                                    </div>
                                    <div class="skill-tags">
    <span
        v-for="skill in skills.data"
        :key="skill.id"
        class="skill-tag"
    >
      {{ skill.name }}
<!--      <v-icon-->
<!--          v-if="hoveredSkill === skill.id"-->
<!--          class="remove-icon"-->
<!--          @click="removeSkill(skill)"-->
<!--      >-->
          <i  @click="removeSkill(skill.id)" class="feather-trash remove-icon"></i>
<!--      </v-icon>-->
    </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>


                <div id="password_tab" class="tab-pane fade">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Change Password</h5>
                            <div class="row">
                                <div class="col-md-10 col-lg-6">
                                    <!--                                        <form>-->
                                    <!--                                            <div class="form-group">-->
                                    <!--                                                <label>Old Password</label>-->
                                    <!--                                                <input type="password" class="form-control">-->
                                    <!--                                            </div>-->
                                    <!--                                            <div class="form-group">-->
                                    <!--                                                <label>New Password</label>-->
                                    <!--                                                <input type="password" class="form-control">-->
                                    <!--                                            </div>-->
                                    <!--                                            <div class="form-group">-->
                                    <!--                                                <label>Confirm Password</label>-->
                                    <!--                                                <input type="password" class="form-control">-->
                                    <!--                                                -->
                                    <!--                                            </div>-->
                                    <!--                                            <button class="btn btn-primary" type="submit">Save Changes</button>-->
                                    <!--                                        </form>-->
                                    <UpdatePasswordForm class="form-control"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head, router, useForm} from '@inertiajs/vue3';
import Chip from "@/Components/Chip.vue";
import { usePage } from '@inertiajs/vue3'
export default {
    layout: AuthenticatedLayout,
    components: {
        Head,
        UpdateProfileInformationForm,
        UpdatePasswordForm,
        DeleteUserForm,
        Chip
    },
    props: {
        skills: Array,
        mustVerifyEmail: {
            type: Boolean,
        },
        status: {
            type: String,
        },
    },
    setup() {
        const { skills } = usePage().props

        const removeSkill = async (skillId) => {
        router.post(route('removeSkill',skillId),{
                preserveScroll: true
        })

        }

        return {
            // skills,
            removeSkill
        }
    },
    data: () => ({
        numberOfInputs: 0,

    }),

    methods: {
        addInput: function () {
            this.numberOfInputs++;
        },
    },
};
</script>

<style>
.remove-icon {
    margin-left: 4px;
    cursor: pointer;
    display: none;
}

.skill-tag:hover .remove-icon {
    display: inline-block;
}
</style>





