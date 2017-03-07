<!DOCTYPE html>
<html>
  <head>
    <title>در حال انتقال ...</title>
  </head>
  <body>
    <form action="https://fcp.shaparak.ir/_ipgw_//payment/simple/" method="post" style="display: none;" id="form">
      <fieldset>
        <p>Merchant ID:
          <input type="text" name="MID" value="21339760"/>
        </p>
        <p>ResNum:
          <input type="text" name="resNum" value="{{ $resNum }}"/>
        </p>
        <p>Good Reference ID:
          <input type="text" name="goodReferenceId" value=""/>
        </p>
        <p>Merchant Data:
          <input type="text" name="merchantData" value=""/>
        </p>
        <p>Amount:
          <input type="text" name="Amount" value="{{ $amount }}"/>
        </p>
        <p>Redirect URL:
          <input type="text" name="redirectURL"
          value="{{ $redirect }}"/>
        </p>
        <p>Lang:
          <input type="text" name="language" value="fa"/>
        </p>
      </fieldset>
      <p>
        <input type="submit" value="Submit"/>
      </p>
    </form>
    <script type="text/javascript">
    document.getElementById('form').submit();
    </script>
  </body>
</html>