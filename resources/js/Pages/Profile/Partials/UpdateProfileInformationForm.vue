<script setup>
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

const form = useForm({
    name: user.name,
    email: user.email,
    telephone: user.telephone || '',  // Defaulting to an empty string if not already set
    gender: user.gender || '',
    title: user.title || '',
    location: user.location || '',
    bio: user.bio || '',
    skills: user.skills || '',
    experience: user.experience || '',
    image: null,
    resume: null
});

function handleFileUpload(field, event) {
    form[field] = event.target.files[0];
    console.log(event.target.files[0]);
}

const submit = () => {
    console.log(form.data());  // Log form data to see what's being submitted
    form.post(route('profile.update'), {
        forceFormData:true,
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
                Update your account's profile information and email address.
            </p>
        </header>

        <form @submit.prevent="submit" class="mt-6 space-y-6" enctype="multipart/form-data">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus
                    autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                    autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="telephone" value="Telephone" />
                <TextInput id="telephone" type="text" class="mt-1 block w-full" v-model="form.telephone"
                    autocomplete="tel" />
                <InputError class="mt-2" :message="form.errors.telephone" />
            </div>

            <div>
                <InputLabel for="gender" value="Gender" />
                <select id="gender" class="mt-1 block w-full" v-model="form.gender">
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <InputError class="mt-2" :message="form.errors.gender" />
            </div>

            <div>
                <InputLabel for="title" value="Title" />
                <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" autocomplete="off" />
                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div>
                <InputLabel for="location" value="Location" />
                <TextInput id="location" type="text" class="mt-1 block w-full" v-model="form.location"
                    autocomplete="off" />
                <InputError class="mt-2" :message="form.errors.location" />
            </div>

            <div>
                <InputLabel for="bio" value="Bio" />
                <textarea id="bio" class="mt-1 block w-full" v-model="form.bio" rows="3"></textarea>
                <InputError class="mt-2" :message="form.errors.bio" />
            </div>

            <div>
                <InputLabel for="skills" value="Skills" />
                <textarea id="skills" class="mt-1 block w-full" v-model="form.skills" rows="3"></textarea>
                <InputError class="mt-2" :message="form.errors.skills" />
            </div>

            <div>
                <InputLabel for="experience" value="Experience" />
                <textarea id="experience" class="mt-1 block w-full" v-model="form.experience" rows="3"></textarea>
                <InputError class="mt-2" :message="form.errors.experience" />
            </div>

            <div>
                <InputLabel for="image" value="Profile Image" />
                <input type="file" id="image" @change="handleFileUpload('image', $event)" />
                <InputError class="mt-2" :message="form.errors.image" />
            </div>

            <div>
                <InputLabel for="resume" value="Resume" />
                <input type="file" id="resume" @change="handleFileUpload('resume', $event)" />
                <InputError class="mt-2" :message="form.errors.resume" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link :href="route('verification.send')" method="post" as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Click here to re-send the verification email.
                    </Link>
                </p>

                <div v-show="status === 'verification-link-sent'" class="mt-2 font-medium text-sm text-green-600">
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
