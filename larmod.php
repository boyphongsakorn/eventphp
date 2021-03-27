<!-- Modal -->
<div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เข้าสู่ระบบ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="checklogin.php" method="post">
          <div class="form-group">
            <label for="eoulogin">อีเมล/ชื่อผู้ใช้</label>
            <input type="text" class="form-control" id="eoulogin" name="eou">
          </div>
          <div class="form-group">
            <label for="passlogin">รหัสผ่าน</label>
            <input type="password" class="form-control" id="passlogin" name="password">
          </div>
      </div>
      <div class="modal-footer">
        <!--button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button-->
        <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="regModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">สมัครสมาชิก</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form autocomplete="off" action="register.php" method="post">
          <div class="form-group">
            <label for="idinput">รหัสบัตรประชาชน</label>
            <input type="search" class="form-control" id="idinput" pattern="[0-9]{13}" name="id" title="รหัสบัตรประชาชนต้องมีสิบสามหลัก" required>
          </div>
          <div class="form-group">
            <label for="nameinput">ชื่อ-นามสกุล</label>
            <input type="search" class="form-control" id="nameinput" name="name" required>
          </div>
          <div class="form-group">
            <label for="usernameinput">ชื่อผู้ใช้</label>
            <input type="search" class="form-control" pattern="([A-Za-z])\w+" id="usernameinput" name="username" title="เฉพาะภาษาอังกฤษ ตัวเลข และ ตัวอักษรพิเศษ (_) เท่านั้น" required>
          </div>
          รหัสผ่าน
          <div class="row">
            <div class="col">
              <input type="password" class="form-control" placeholder="รหัสผ่าน" name="password" required>
            </div>
            <div class="col">
              <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" name="recheckpassword" required>
            </div>
          </div>
          <div class="form-group">
            <label for="emailinput">อีเมล</label>
            <input type="search" class="form-control" id="emailinput" placeholder="name@example.com" pattern="^(?![\.\-_])((?![\-\._][\-\._])[a-z0-9\-\._]){0,63}[a-z0-9]@(?![\-])((?!--)[a-z0-9\-]){0,63}[a-z0-9]\.(|((?![\-])((?!--)[a-z0-9\-]){0,63}[a-z0-9]\.))(|([a-z]{2,14}\.))[a-z]{2,14}$" name="email">
          </div>
          <div class="form-group">
            <label for="addressinput">ที่อยู่</label>
            <input type="search" class="form-control" id="addressinput" name="address">
          </div>
      </div>
      <div class="modal-footer">
        <!--button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button-->
        <button type="submit" class="btn btn-primary">สมัคร</button>
        </form>
      </div>
    </div>
  </div>
</div>