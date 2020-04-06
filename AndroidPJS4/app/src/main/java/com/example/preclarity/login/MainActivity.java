package com.example.preclarity.login;

import androidx.activity.OnBackPressedCallback;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.StrictMode;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.preclarity.Forum.AccueilForum;
import com.example.preclarity.ListChatActivity;
import com.example.preclarity.MenuActivity;
import com.example.preclarity.R;

import java.util.List;
import java.util.concurrent.ExecutionException;

public class MainActivity extends AppCompatActivity {
    private static final String TAG = "MAIN ACTIVITY";
    private EditText etLogin;
   private EditText etPwd;
   private Button loginBtn;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_main);
        if (android.os.Build.VERSION.SDK_INT > 9)
        {
            StrictMode.ThreadPolicy policy = new
                    StrictMode.ThreadPolicy.Builder().permitAll().build();
            StrictMode.setThreadPolicy(policy);
        }
        etLogin = (EditText) findViewById(R.id.login);
        etPwd = (EditText) findViewById(R.id.pwd);
        loginBtn = (Button) findViewById(R.id.btnLogin);
        OnBackPressedCallback callback = new OnBackPressedCallback(true) {
            @Override
            public void handleOnBackPressed() {
                Intent homeIntent = new Intent(Intent.ACTION_MAIN);
                homeIntent.addCategory( Intent.CATEGORY_HOME );
                homeIntent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                startActivity(homeIntent);
            }
        };

        Context context = getApplicationContext();
        SharedPreferences sharedPref = context.getSharedPreferences("user",Context.MODE_PRIVATE);
        //si user s'est déja authentifié
        if(sharedPref.contains("id")){
            Log.w(TAG,String.valueOf(sharedPref.getInt("id",-1)));
              startActivity(new Intent(this, MenuActivity.class));
        }

        loginBtn.setOnClickListener(new View.OnClickListener(){

            @Override
            public void onClick(View v) {
                try {
                    int id = verif();
                    Log.w("MON ID :: :: ", String.valueOf(id));
                    if(id>0){//si user s'est correctement authentifié
                        Context context = getApplicationContext();

                        SharedPreferences sharedPref = context.getSharedPreferences("user",Context.MODE_PRIVATE);

                        SharedPreferences.Editor edit = sharedPref.edit();
                        edit.putInt("id", id);
                        edit.commit();
                         startActivity(new Intent(context, MenuActivity.class));
                        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
                    }else{
                        Toast.makeText(MainActivity.this, "Authentification failed", Toast.LENGTH_LONG).show();
                    }
                } catch (ExecutionException e) {
                    e.printStackTrace();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }

            }
        });

    }

    private int verif() throws ExecutionException, InterruptedException {
        String login = etLogin.getText().toString();
        String pwd = etPwd.getText().toString();
        String type ="login";
        BackgroundWorker bw = new BackgroundWorker(this);
       return bw.execute(type,login,pwd).get();
    }


}
