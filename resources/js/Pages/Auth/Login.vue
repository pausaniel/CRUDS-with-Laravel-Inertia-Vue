<script setup>
import Container from '../../Components/Container.vue';
import Title from '../../Components/Title.vue';
import TextLink from '../../Components/TextLink.vue';
import InputField from '../../Components/InputField.vue';
import PrimaryBtn from '../../Components/PrimaryBtn.vue';
import ErrorMessages from '../../Components/ErrorMessages.vue';
import Checkbox from '../../Components/Checkbox.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email:"",
    password:"",
    remember: null,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset("password"),
    });
};

</script>

<template>
    <Head title="- Login"/>
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <Title>Login to your account</Title>
            <p>
                Need and account?
                <TextLink routeName="register" label="Register"/>
            </p>
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <InputField 
            label="Email" 
            type="email" 
            icon="at" 
            v-model="form.email"
            />

            <InputField 
            label="Password" 
            type="password" 
            icon="key" 
            v-model="form.password"/>

            <div class="flex items-center justify-between">

                <Checkbox name="remember" v-model="form.remember">Remember me</Checkbox>
                <TextLink routeName="home" label="Forgot Password?"/>

            </div>

            <!-- Error messages -->
            <ErrorMessages :errors="form.errors" />

            <PrimaryBtn :disabled="form.processing">
                Login
            </PrimaryBtn>

        </form>

    </Container>
</template>