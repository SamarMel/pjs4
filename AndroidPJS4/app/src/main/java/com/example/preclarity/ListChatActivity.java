package com.example.preclarity;

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
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ListView;

import com.example.preclarity.Forum.AccueilForum;
import com.example.preclarity.Forum.Topic;
import com.example.preclarity.chat.ContactBackgroundWorker;
import com.example.preclarity.chat.Conversation;
import com.example.preclarity.chat.ConversationActivity;
import com.example.preclarity.chat.ListChatAdapter;
import com.example.preclarity.chat.ListChatBackgroundWorker;
import com.example.preclarity.chat.Utilisateur;

import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.ExecutionException;

public class ListChatActivity extends AppCompatActivity {

    private static final String TAG = "LISTCHAT :";
    private ListView listeContact;
    private Button menu;
    private Button refresh;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        this.getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_list_chat);
        if (android.os.Build.VERSION.SDK_INT > 9)
        {
            StrictMode.ThreadPolicy policy = new
                    StrictMode.ThreadPolicy.Builder().permitAll().build();
            StrictMode.setThreadPolicy(policy);
        }
        listeContact = (ListView) findViewById(R.id.listConv);
        menu = (Button) findViewById(R.id.btnMenu);
        menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                startActivity(new Intent(ListChatActivity.this, MenuActivity.class));
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
            }
        });
        refresh = (Button) findViewById(R.id.btnRefresh);
        refresh.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                ListChatActivity.this.recreate();
            }
        });
        Context context = getApplicationContext();
        //liste contenant pseudo et photo
        ArrayList<String> info = new ArrayList<>();
        //liste des utilisateurs avec qui on a une discussion privée
        List<Utilisateur> convs = new ArrayList<>();

        SharedPreferences sharedPref = context.getSharedPreferences("user",Context.MODE_PRIVATE);
        int idAuteur = sharedPref.getInt("id",-1);

        //liste contenant les idConversation et id de l'ami
        List<Conversation> ids = getIdFriends(idAuteur);
        //pour chaque ami, on cherche son pseudo et sa photo de profile
        for(Conversation id : ids){
            ContactBackgroundWorker contactBw = new ContactBackgroundWorker();
            try {
                 info = (ArrayList<String>) contactBw.execute(id.getIdFriend()).get();
            } catch (ExecutionException e) {
                e.printStackTrace();
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
            Log.w(TAG, String.valueOf(info.size()));
            String pseudo = info.get(0);
            String photo = info.get(1);
            convs.add(new Utilisateur(id.getIdFriend(),pseudo, photo,id.getIdConv()));
        }
        ListChatAdapter adapter = new ListChatAdapter(this, convs);
        listeContact.setAdapter(adapter);
        listeContact.setClickable(true);
        listeContact.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                //renter dans activité des messages de la conversation
                Utilisateur contact = (Utilisateur) listeContact.getItemAtPosition(position);
                int idConv = contact.getIdConv();
                String pseudo = contact.getPseudo();
                Intent intent = new Intent(ListChatActivity.this, ConversationActivity.class);
                intent.putExtra("idConv", idConv);
                intent.putExtra("pseudo", pseudo);
                ListChatActivity.this.startActivity(intent);
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);
            }
        });

        OnBackPressedCallback callback = new OnBackPressedCallback(true) {
            @Override
            public void handleOnBackPressed() {
                startActivity(new Intent(ListChatActivity.this, MenuActivity.class));
                overridePendingTransition(R.anim.slide_in_right, R.anim.slide_out_left);

            }
        };


    }
    public List<Conversation> getIdFriends(int id){
        ListChatBackgroundWorker convBw= new ListChatBackgroundWorker(this);
        List<Conversation> ids =null;
        try{
            ids =  convBw.execute(id).get();
        }catch(InterruptedException | ExecutionException e){
            Log.w(TAG, "IterruptedException");
        }
        return ids;

    }

}
