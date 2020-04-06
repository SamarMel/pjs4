package com.example.preclarity.chat;

import android.annotation.SuppressLint;
import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

import com.example.preclarity.Post;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.ExecutionException;

public class ListChatBackgroundWorker extends AsyncTask<Integer, Void, List<Conversation>> {
    private static final String TAG = "ListChat BW";
    Context context;

   public ListChatBackgroundWorker(Context ctx){
       context = ctx;
   }


    @Override
    protected List<Conversation> doInBackground(Integer... integers) {
       Integer idUser = integers[0];
       String login_url="http://pjs4.ulyssebouchet.fr/Android/Conversations.php";
       List<Utilisateur> convs = new ArrayList<Utilisateur>();
       List<Conversation> idFriends = new ArrayList<>();
       String result="";

        try {
            URL url = new URL(login_url);
            HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
            httpURLConnection.setRequestMethod("POST");
            httpURLConnection.setDoOutput(true);
            httpURLConnection.setDoInput(true);
            OutputStream outputStream = httpURLConnection.getOutputStream();
            BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
            String post_data = URLEncoder.encode("idUser","UTF-8")+"="+URLEncoder.encode(String.valueOf(idUser),"UTF-8");
            bufferedWriter.write(post_data);
            bufferedWriter.flush();
            bufferedWriter.close();
            outputStream.close();
            InputStream inputStream = httpURLConnection.getInputStream();
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream,"iso-8859-1"));
            // String result="";
            String line="";
            while((line = bufferedReader.readLine())!= null) {
                result += line;
            }
            bufferedReader.close();
            inputStream.close();
            httpURLConnection.disconnect();

        } catch (MalformedURLException e) {
            Log.w(TAG, "Malformated EXCEPTIOOOOOOOON");
        } catch (IOException e) {
            Log.w(TAG, "IO EXCEPTIOOOOOOOON");
        }

        try {
            String s="";
            JSONArray jArray = new JSONArray(result);
            for(int i =0; i<jArray.length();i++){

                JSONObject json = jArray.getJSONObject(i);
                int idConv = json.getInt("id");
                int idUser1 = json.getInt("idUser1");
                int idUser2 = json.getInt("idUser2");
                Log.w(TAG, String.valueOf(idConv)+"  "+ String.valueOf(idUser1));
                if (idUser == idUser1) {
                    Log.w(TAG, "user1");
                    idFriends.add(new Conversation(idUser2,idConv));

                   // ContactBackgroundWorker contactBw = new ContactBackgroundWorker();
                    //@SuppressLint("WrongThread") ArrayList<String> info = (ArrayList<String>) contactBw.execute(idUser2).get();
                    //String pseudo = info.get(0);
                    //String photo = info.get(1);
                    //convs.add(new Utilisateur(idUser2,pseudo, photo,idConv));
                    //new Utilisateur idUser2

                }else{
                    Log.w(TAG, "user2");
                    idFriends.add(new Conversation(idUser1,idConv));
                    //ContactBackgroundWorker contactBw = new ContactBackgroundWorker();
                    //@SuppressLint("WrongThread") ArrayList<String> info = (ArrayList<String>) contactBw.execute(idUser1).get();
                    //String pseudo = info.get(0);
                    //String photo = info.get(1);
                    //convs.add(new Utilisateur(idUser1,pseudo, photo,idConv));
                    ///new Utilisateur id User2
                }

            }
            Log.w(TAG, "avant la boucle de verif-------------");
            for(Utilisateur u: convs){
                Log.w(TAG, u.getPseudo());
            }

            return idFriends;
            // TopicAdapter adapter = new TopicAdapter(context, lastTopics);

        } catch (JSONException e) {
            e.printStackTrace();
        }


        return null;
    }
}
