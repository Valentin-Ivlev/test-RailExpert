<template>
    <div>
        <h2>Список пользователей</h2>
        <ul class="list-group">
            <li v-for="user in users" :key="user.id" class="list-group-item">
                {{ user.name }} - Навыки: {{ user.description }}
            </li>
        </ul>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const users = ref([]);

        const fetchUsers = async () => {
            try {
                const response = await axios.get('/api/users');
                users.value = response.data;
            } catch (error) {
                console.error('Ошибка при получении пользователей:', error);
            }
        };

        onMounted(fetchUsers);

        return { users, fetchUsers };
    }
}
</script>
