<script setup>
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('account.create'), {
        // onFinish: () => alert('success'),
    });
};
</script>
<script>
import GuestLayout from "@/Layouts/GuestLayout.vue";

export default {
    layout:GuestLayout,
}
</script>

<template>
    <!--    <GuestLayout>-->
    <Head title="Register" />

    <div class="main-wrapper login-body">

        <div class="login-wrapper">

            <div class="container">

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
                            <h1>Welcome to Preskool</h1>
                            <!--                                <p class="account-subtitle">Need an account? <a href="register.html">Sign Up</a></p>-->
                            <h2>Sign in</h2>

                            <form @submit.prevent="submit">
                                <div class="form-group">
                                    <label>Username <span class="login-danger">*</span></label>
                                    <TextInput
                                        id="name"
                                        type="text"
                                        class="form-control"
                                        v-model="form.name"

                                        autofocus
                                        autocomplete="name"
                                    />

                                    <InputError class="mt-2" :message="form.errors.name" />
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                </div>
                                <div class="form-group">
                                    <label>Email <span class="login-danger">*</span></label>
                                    <TextInput
                                        id="email"
                                        type="email"
                                        class="form-control"
                                        v-model="form.email"

                                        autocomplete="username"
                                    />
                                    <InputError class="mt-2" :message="form.errors.email" />
                                    <span class="profile-views"><i class="fas fa-mail-bulk"></i></span>
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <!--                                        <input class="form-control pass-input" type="text">-->
                                    <TextInput
                                        id="password"
                                        type="password"
                                        class="form-control pass-input"
                                        v-model="form.password"

                                        autocomplete="new-password"                                        />
                                    <!--                                        <span class="profile-views feather-eye toggle-password"></span>-->
                                    <InputError class="mt-2" :message="form.errors.password" />
                                    <span class="profile-views"><i class="fas fa-lock"></i></span>
                                </div>
                                <div class="form-group">
                                    <label>Conform Password <span class="login-danger">*</span></label>

                                    <TextInput
                                        id="password_confirmation"
                                        type="password"
                                        class="form-control pass-input"
                                        v-model="form.password_confirmation"
                                        autocomplete="new-password"
                                    />
                                    <span class="profile-views"><i class="fas fa-lock"></i></span>
                                </div>
                                <div class="forgotpass">
                                    <div class="remember-me">
                                        <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                                            <Checkbox name="remember" v-model:checked="form.remember" />
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <Link
                                        :href="route('login')"
                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                    >
                                        Already registered?
                                    </Link>
                                    <!--                                        <a href="forgot-password.html">Forgot Password?</a>-->
                                </div>
                                <div class="form-group">
                                    <PrimaryButton style="background-color: #0a53be" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Register
                                    </PrimaryButton>
                                    <!--                                        <button class="btn btn-primary btn-block" type="submit">Login</button>&ndash;&gt;-->
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
