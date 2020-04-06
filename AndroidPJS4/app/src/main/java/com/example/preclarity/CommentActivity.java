package com.example.preclarity;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.Editable;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.example.preclarity.Forum.AccueilForum;
import com.example.preclarity.chat.ConversationActivity;
import com.example.preclarity.login.MainActivity;

import java.util.concurrent.ExecutionException;

public class CommentActivity extends AppCompatActivity {
    private static final String TAG = "COMMENT ACTIVITY" ;
    private Button submitBtn;
    private EditText commentEt;
    private int idTopic;
    private CommentBackgroundWorker commentbW;
    private Button menu;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_comment);
        submitBtn = (Button) findViewById(R.id.submitComment);
        commentEt = (EditText) findViewById(R.id.comment);
        menu = (Button) findViewById(R.id.btnMenu);
        menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(CommentActivity.this, MenuActivity.class));
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
            }
        });
        Bundle b = getIntent().getExtras();
        if (b != null) {
            idTopic = b.getInt("idTopic");
            commentbW = new CommentBackgroundWorker(this);

            submitBtn.setOnClickListener(new View.OnClickListener() {

                @Override
                public void onClick(View v) {
                    //entrer le commentaire dans la bd
                    //Toast de validation
                    boolean b = false;
                    Context context = getApplicationContext();

                    SharedPreferences sharedPref = context.getSharedPreferences("user",Context.MODE_PRIVATE);
                    int idAuteur = sharedPref.getInt("id",-1);
                    String text = commentEt.getText().toString();
                    try {
                        Log.w(TAG, String.valueOf(idTopic));
                        Log.w(TAG, String.valueOf(idAuteur));
                        b = commentbW.execute(String.valueOf(idTopic), String.valueOf(idAuteur), text).get();
                        Log.w("COMMENT:", String.valueOf(b));
                    } catch (ExecutionException e) {
                        e.printStackTrace();
                    } catch (InterruptedException e) {
                        e.printStackTrace();
                    }
                    if (b) {
                        Toast.makeText(CommentActivity.this, "Post enregistré", Toast.LENGTH_LONG).show();
                        Intent intent = new Intent(CommentActivity.this, AccueilForum.class);
                        intent.putExtra("idTopic", idTopic);
                        CommentActivity.this.startActivity(intent);
                        overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);

                    } else
                        Toast.makeText(CommentActivity.this, "Echec d'enregistrement de votre post", Toast.LENGTH_LONG).show();
                }
            });
        }
    }
}
