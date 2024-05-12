<script setup>
import { ref } from 'vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;
const profileImage = ref(user.image || '');
const form = useForm({
    name: user.name,
    email: user.email,
    telephone: user.telephone || '',
    image: user.image || '',
    location: user.location || '',
    no_of_employees: user.no_of_employees || '',
    bio: user.bio || '',
});


async function handleFileUpload(field, event) {
    const file = event.target.files[0];  
    if (file) {
        form[field] = file;
        profileImage.value = URL.createObjectURL(file);
        console.log(profileImage.value);
    }
}

const submit = () => {
    form.post(route('employer.profile.update'), {
        forceFormData: true,
        onSuccess: () => console.log("Form submitted successfully"),
        onError: error => console.error("Error submitting form", error)
    });
};

</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>
            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information.
            </p>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6" enctype="multipart/form-data">
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="telephone" value="Telephone" />
                <TextInput id="telephone" type="text" class="mt-1 block w-full" v-model="form.telephone" autocomplete="tel" />
                <InputError class="mt-2" :message="form.errors.telephone" />
            </div>

            <div>
                <InputLabel for="image" value="Profile Image" />
                <input type="file" id="image" @change="handleFileUpload('image', $event)" />
                <InputError class="mt-2" :message="form.errors.image" />
            </div>
            <div v-if="profileImage" style="width: 200px; height: 200px; overflow: hidden; border-radius: 50%;">
                <img :src="profileImage" class="w-full h-full object-cover" />
            </div>
            <div>
                <InputLabel for="location" value="Location" />
                <TextInput id="location" type="text" class="mt-1 block w-full" v-model="form.location" autocomplete="off" />
                <InputError class="mt-2" :message="form.errors.location" />
            </div>

            <div>
                <InputLabel for="no_of_employees" value="Number of Employees" />
                <TextInput id="no_of_employees" type="text" class="mt-1 block w-full" v-model="form.no_of_employees" autocomplete="off" />
                <InputError class="mt-2" :message="form.errors.no_of_employees" />
            </div>

            <div>
                <InputLabel for="bio" value="Bio" />
                <textarea id="bio" class="mt-1 block w-full" v-model="form.bio" rows="3"></textarea>
                <InputError class="mt-2" :message="form.errors.bio" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
                <transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0" leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </transition>
            </div>
        </form>
    </section>
</template>
