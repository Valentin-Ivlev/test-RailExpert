import './bootstrap';
import { createApp } from 'vue';
import UserList from './components/UserList.vue';
import UserForm from './components/UserForm.vue';

const app = createApp({
    components: {
        UserList,
        UserForm
    },
    data() {
        return {
            userListRef: null
        }
    },
    methods: {
        onUserCreated() {
            if (this.userListRef) {
                this.userListRef.fetchUsers();
            }
        }
    },
    template: `
    <div>
      <UserList ref="userList" />
      <UserForm @user-created="onUserCreated" />
    </div>
  `,
    mounted() {
        this.userListRef = this.$refs.userList;
    }
});

app.mount('#app');
