<script setup>
import Checkbox from '@/Components/Checkbox.vue';
// import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '../../Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    name: '',
    password: '',
    remember: false,
});
function error(mesg) {
    toastr.error(mesg)
}
const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
<template>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div class="main-wrapper login-body">

            <div class="login-wrapper">
                <div class="container">
<!--                    <div v-if="$page.props.ziggy.flash.error" class="mb-4 font-medium text-sm text-green-600">-->
<!--                        {{ $page.props.ziggy.flash.error }}-->
<!--                    </div>-->

                    <v-alert
                        v-if="$page.props.ziggy.flash.error"
                        variant="outlined"
                        type="warning"
                        prominent
                        border="top"
                    >
                        {{ $page.props.ziggy.flash.error }}
                    </v-alert>
                    <div class="loginbox">
                        <div class="login-left">
                            <img class="img-fluid" src="assets/img/login.png" alt="Logo">
                        </div>
                        <div class="login-right">
                            <div class="login-right-wrap">
                                <h1>Welcome to JfrO</h1>
                                <p class="account-subtitle">Need an account? <Link :href="route('register')">Sign Up</Link></p>
                                <h2>Sign in</h2>

                                <form @submit.prevent="submit">
                                    <div class="form-group">
                                        <label>Username / Email <span class="login-danger">*</span></label>
                                        <TextInput
                                            id="name"
                                            type="text"
                                            class="form-control"
                                            v-model="form.name"
                                            required
                                            autofocus
                                            autocomplete="username"
                                        />

                                        <InputError class="mt-2" :message="form.errors.name" />
                                        <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Password <span class="login-danger">*</span></label>
<!--                                        <input class="form-control pass-input" type="text">-->
                                        <TextInput
                                            id="password"
                                            type="password"
                                            class="form-control pass-input"
                                            v-model="form.password"
                                            required
                                            autocomplete="current-password"
                                        />
                                        <span class="profile-views feather-eye toggle-password"></span>
                                    </div>
                                    <div class="forgotpass">
                                        <div class="remember-me">
                                            <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                                                <Checkbox name="remember" v-model:checked="form.remember" />
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <Link
                                            v-if="canResetPassword"
                                            :href="route('password.request')"
                                        >
                                            Forgot your password?
                                        </Link>
<!--                                        <a href="forgot-password.html">Forgot Password?</a>-->
                                    </div>

                                    <div class="form-group">
                                        <PrimaryButton class="ml-4" style="background-color: #0a53be" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" >
                                            Log in
                                        </PrimaryButton>
<!--                                        <button class="btn btn-primary btn-block" type="submit">Login</button>-->
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>
import GuestLayout from "@/Layouts/GuestLayout.vue";

export default {
    Layout: GuestLayout
}
</script>
