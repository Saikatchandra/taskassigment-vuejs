<template>
  <div>
        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Task add to User</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Task add to User</li>
              </ol>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->

      <section class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add  Task to user</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form  @submit.prevent="saveAssignUser" @keydown="form.onKeydown($event)">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Select User</label>
                      <select class="form-control"
                        name="user"
                        v-model="form.user">
                        <option value="" selected>Select a user</option>
                        <option :value="user.id" v-for="user in getUserList" :key="user.id">{{user.name}}</option>
                      </select>
                      <div
                        v-if="form.errors.has('user')"
                        v-html="form.errors.get('user')"
                      />
                    </div>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-3">
                      Submit
                    </button>
                    <router-link to="/" class="btn btn-warning">
                      Back</router-link
                    >
                    <!-- <button type="submit" @click="goBack" class="btn btn-warning">Back</button> -->
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  </div>
</template>

<script>
import Form from "vform";
export default {
  name: "add",

   data: () => ({
    form: new Form({
      user: "",
    }),
  }),

  mounted() {
    this.$store.dispatch("getUserList");
  },
  computed: {
    getUserList() {
      return this.$store.getters.userList;
    },
  },
  
  methods:{
    saveAssignUser(){
      this.form.post(`/assign-task-to-user/${this.$route.params.taskId}`)
      .then((res) => {
        console.log(res);
        this.$router.push('/');
        Toast.fire({
            icon: "success",
            title: "Task assigned successfully",
          });
      }).catch((e) => {
        console.log(e);
      })
    }
  }


};
</script>

<style lang="scss" scoped>
</style>