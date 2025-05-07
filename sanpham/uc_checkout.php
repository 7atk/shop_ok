
<form method="post" action="index.php?page=uc_checkout">
  <div class="row">
    <div class="col-6">
      <div class="d-grid"><button type="button" class="btn btn-primary fw-bold">THÔNG TIN KHÁCH HÀNG</button> </div>
      <table class="table table-striped table-hover">
        <tr>
          <td>Mã khách hàng: </td>
          <td><input name="makh" type="text" readonly class="bg-info" id="makh" value="<?php echo !empty($data['makh']) ? $data['makh'] : ''; ?>" />
          </td>
        </tr>
        <tr>
          <td>Tên khách hàng: </td>
          <td>
            <input name="tenkh" type="text" value="<?php echo !empty($data['tenkh']) ? $data['tenkh'] : ''; ?>" />
          </td>
        </tr>
        <tr>
          <td>Phái:</td>
          <td><label>
              <input name="phai" type="radio" checked="checked" value="0" <?php if ($data['phai'] == '0') echo "checked='checked'"; ?> />
              Nữ</label>
            <label>
              <input name="phai" type="radio" value="1" <?php if ($data['phai'] == '1') echo "checked='checked'"; ?> />
              Nam</label>
          </td>
        </tr>
        <tr>
          <td>Địa chỉ: </td>
          <td><input name="diachi" type="text" id="diachi" value="<?php echo !empty($data['diachi']) ? $data['diachi'] : ''; ?>" /></td>
        </tr>
        <tr>
          <td>Phone:</td>
          <td><input name="phone" type="text" id="phone" value="<?php echo !empty($data['phone']) ? $data['phone'] : ''; ?>" /></td>
        </tr>
        <tr>
          <td>Email:</td>
          <td><input name="email" type="text" id="email" value="<?php echo !empty($data['email']) ? $data['email'] : ''; ?>" /></td>
        </tr>
        <tr>
          <td>Thanh toán</td>
          <td><label>
              <input name="tt" type="radio" value="0" checked <?php if ($tt == "0") echo "checked='checked'"; ?> />
              Miền mặt</label>
            <label>
              <input name="tt" type="radio" value="1" <?php if ($tt == "1") echo "checked='checked'"; ?> />
              Chuyển khoản</label>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input class="btn btn-primary" type="submit" name="ok" value="Gửi thông tin đặt hàng" /></td>
        </tr>
      </table>
    </div>
    <div class="col-6">
      <div class="text-bg-info pt-1 pb-1 text-center fw-bold rounded">THÔNG TIN GIỎ HÀNG >></div>
      <?php
      if (isset($_SESSION['cart'])) {
        $stt = 1;
        foreach ($_SESSION['cart'] as $id => $row) { //$id hay là $key
          $subtotal = ($row["price"] * $row["quantity"]);
          $total = ($total + $subtotal);
      ?>
          <?php echo $stt. '.<a class="btn link-danger mb-1" 
          href="index.php?page=product_detail&id=' . $id . '">' . $row['name'] . '</a>'; ?>
          <table class="table table-bordered table-sm">
            <thead class="text-center fw-bold">
              <tr>
                <th>ID</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center"><?php echo $id; ?></td>
                <td class="text-end"><?php echo number_format($row['price']); ?></td>
                <td class="text-center"><?php echo $row['quantity']; ?>
                </td>
                <td class="text-end">
                  <?php echo  number_format($subtotal); ?>
                </td>
              </tr>
            </tbody>
          </table>
      <?php
          $stt++;
        }
      }
      ?>
      <div>
        <span class="btn btn-outline-primary col-12 text-end"><strong>Tổng tiền:
          <?php echo number_format($total, 0); ?>&nbsp;VNĐ</strong></span>
      </div>
    </div>
  </div>
</form>