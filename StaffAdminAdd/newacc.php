<form method="post" enctype="multipart/form-data" class="mt-2">
            <select class="form-control" id="role" name="role" placeholder="Choose Role..." > 
                  <option value="staff">Staff</option>
                  <option value="admin">Admin</option>
            </select>

            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" class="form-control" placeholder="Name..." name="name" required>
            </div>

            <div class="form-group">
              <label for="gender">Gender</label>
            <div class="form-check form-check-inline">
              <input class="form-check-input ml-4" type="radio" name="gender" id="male" value="Male" required>
              <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
              <label class="form-check-label" for="female">Female</label>
            </div>
            </div>

            <div class="form-group">
              <label for="address">Address</label>
              <textarea class="form-control" id="address" rows="3" name="address" placeholder="adress.." required></textarea>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="phone" class="form-control" id="phone" name="phone" placeholder="phone..." required>
            </div>

            <div class="form-group">
              <label for="Email">Email address</label>
              <input type="email" class="form-control" id="Email" name="email" placeholder="Email..." required>
            </div>
            <div class="form-group">
              <label for="password">password</label>
              <input type="password" id="password" class="form-control" placeholder="password..." name="password" required>
            </div>

            <div class="form-group">
              <label for="password2">Re-password</label>
              <input type="password" id="password2" class="form-control" placeholder="confirm password" name="password2" required>
            </div>

            <button type="submit" class="btn btn-primary" name="newacc">Add New Account</button>
          </form>