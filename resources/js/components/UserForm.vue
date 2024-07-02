<template>
    <div>
        <h2>Создать нового пользователя</h2>
        <Form @submit="onSubmit" :validation-schema="schema" v-slot="{ errors, resetForm }">
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <Field name="name" type="text" class="form-control" :class="{ 'is-invalid': errors.name }" />
                <div class="invalid-feedback">{{ errors.name }}</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <Field name="email" type="email" class="form-control" :class="{ 'is-invalid': errors.email }" />
                <div class="invalid-feedback">{{ errors.email }}</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <Field name="password" type="password" class="form-control" :class="{ 'is-invalid': errors.password }" />
                <div class="invalid-feedback">{{ errors.password }}</div>
            </div>
            <button type="submit" class="btn btn-primary">Создать</button>
        </Form>
    </div>
</template>

<script>
import { Form, Field } from 'vee-validate';
import * as Yup from 'yup';
import axios from 'axios';

export default {
    components: {
        Form,
        Field,
    },
    emits: ['user-created'],
    setup(props, { emit }) {
        const schema = Yup.object().shape({
            name: Yup.string().matches(/^([0-9]{1,12}|[a-zA-Z]+)$/, 'Имя должно содержать либо только цифры (не более 12), либо только буквы'),
            email: Yup.string().required('Email обязателен').email('Неверный формат email'),
            password: Yup.string().required('Пароль обязателен').min(6, 'Пароль должен быть не менее 6 символов'),
        });

        const onSubmit = async (values, { resetForm }) => {
            try {
                const response = await axios.post('/api/users', values);
                alert('Пользователь успешно создан');
                emit('user-created', response.data);
                resetForm();
            } catch (error) {
                console.error('Ошибка при создании пользователя:', error);
                alert('Ошибка при создании пользователя');
            }
        };

        return { schema, onSubmit };
    }
}
</script>
