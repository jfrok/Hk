<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import {reactive, watch} from "vue";
import {useDropzone} from "vue3-dropzone";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    job: user.job,
    city: user.city,
    address: user.address,
    description: user.description,
    img:''
});

const state = reactive({
    files: [],
});

const {getRootProps, getInputProps, isDragActive, ...rest} = useDropzone({
    onDrop,
});

watch(state, () => {
    console.log('state', state);
});

watch(isDragActive, () => {
    console.log('isDragActive', isDragActive.value, rest);
});

function onDrop(acceptFiles, rejectReasons) {
    console.log(acceptFiles);
    console.log(rejectReasons);
    console.log(getInputProps());
    form.img = acceptFiles[0];
    state.files = acceptFiles;
}

function handleClickDeleteFile(index) {
    state.files.splice(index, 1);
}

let submit = () => {
    form.post(route('updateProfile'),{
        onSuccess: () =>{
            $('#uploadAvatar').modal('toggle')
        }
    })
}
function openModal() {
    $('#uploadAvatar').modal('show')
}
</script>

<template>
    <section>
        <div class="modal custom-modal fade bank-details" id="uploadAvatar" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="form-header text-start mb-0">
                            <h4 class="mb-0">Upload Image</h4>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="bank-inner-details">
                            <div v-if="state.files.length > 0" class="files">
                                <div class="file-item" v-for="(file, index) in state.files"
                                     :key="index">
                                    <span>{{ file.name }}</span>
                                    <span class="delete-file" @click="handleClickDeleteFile(index)"
                                    >Delete</span
                                    >
                                </div>
                            </div>
                            <div v-else class="dropzone" v-bind="getRootProps()">
                                <div
                                    class="border"
                                    :class="{
          isDragActive,
        }"
                                >
                                    <input type="file" @input="form.img = $event.target.files[0]"
                                           v-bind="getInputProps()"/>
                                    <p v-if="isDragActive">Drop the files here ...</p>
                                    <p v-else>Drag and drop files here, or Click to select files</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="bank-details-btn">
                                <a href="javascript:void(0);" @click="submit" class="btn bank-save-btn">Save</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
<!--        <header>-->
<!--            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>-->

<!--            <p class="mt-1 text-sm text-gray-600">-->
<!--                Update your account's profile information and email address.-->
<!--            </p>-->
<!--        </header>-->

        <form @submit.prevent="form.post(route('updateProfile'))" class="mt-6 space-y-6">
            <div class="row">

                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name</p>
                <p class="col-sm-9">
                <TextInput
                    id="name"
                    type="text"
                    class="form-control"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
                </p>
            </div>

            <div class="row">

                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email</p>
                <p class="col-sm-9">
<!--                <InputLabel for="email" value="Email" />-->

                <TextInput
                    id="email"
                    type="email"
                    class="form-control"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                </p>
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="row">

                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Occupation</p>
                <p class="col-sm-9">
                    <!--                <InputLabel for="email" value="Email" />-->

                    <TextInput
                        id="job"
                        type="text"
                        class="form-control"
                        v-model="form.job"
                        autocomplete="job"
                    />
                </p>
                <InputError class="mt-2" :message="form.errors.job" />
            </div>

            <div class="row">

                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Land</p>
                <p class="col-sm-9">
                    <!--                <InputLabel for="email" value="Email" />-->

                    <TextInput
                        id="city"
                        type="text"
                        class="form-control"
                        v-model="form.city"
                        autocomplete="city"
                    />
                </p>
                <InputError class="mt-2" :message="form.errors.city" />
            </div>

            <div class="row">

                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">City</p>
                <p class="col-sm-9">
                    <!--                <InputLabel for="email" value="Email" />-->

                    <TextInput
                        id="address"
                        type="text"
                        class="form-control"
                        v-model="form.address"
                        autocomplete="address"
                    />
                </p>
                <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <div class="row">

                <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Description</p>
                <p class="col-sm-9">
                    <!--                <InputLabel for="email" value="Email" />-->

                    <textarea
                        id="description"
                        type="text"
                        class="form-control"
                        v-model="form.description"
                        autocomplete="description"
                    ></textarea>
                </p>
                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing" style="float: right;position: relative">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<style lang="scss" scoped>
.dropzone {
    width: 400px;
    height: 200px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    row-gap: 16px;
    border: 2px dashed #3d5ee1;
    background-color: #fff;
    transition: 0.3s ease all;

    label {
        padding: 8px 12px;
        color: #fff;
        background-color: #3d5ee1;
        transition: 0.3s ease all;
    }

    input {
        display: none;
    }
}

.active-dropzone {
    color: #fff;
    border-color: #fff;
    background-color: #3d5ee1;

    label {
        background-color: #fff;
        color: #3d5ee1;
    }
}

.dropzone,
.files {
    width: 100%;
    max-width: 300px;
    margin: 0 auto;
    padding: 10px;
    border-radius: 8px;
    box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
    rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
    font-size: 12px;
    line-height: 1.5;
}

.border {
    border: 2px dashed #ccc;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    transition: all 0.3s ease;
    background: #5f99f3;

    &.isDragActive {
        border: 2px dashed #ffb300;
        background: rgb(255 167 18 / 20%);
    }
}

.file-item {
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgb(255 167 18 / 20%);
    padding: 7px;
    padding-left: 15px;
    margin-top: 10px;

    &:first-child {
        margin-top: 0;
    }

    .delete-file {
        background: red;
        color: #fff;
        padding: 5px 10px;
        border-radius: 8px;
        cursor: pointer;
    }
}
</style>
