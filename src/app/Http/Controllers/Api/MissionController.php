<?php

namespace App\Http\Controllers\Api;

use App\Mail\MissionFeedbackMailable;
use http\Env\Response;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Storage;
use App\Models\Mission;
use Auth;

class MissionController extends Controller
{
    public function create(Request $request)
    {
        try {
            \DB::beginTransaction();

            $mission = new Mission;
            $mission->fill($request->all());
            $mission->user_id = Auth::user()->id;
            $mission->is_public = 1;
            $mission->curtidas = 0;

            if ($request->has('images')) {
                $images = $request->get('images');
                $image = $images[0]['file'];
                preg_match("/data:image\/(.*?);/", $image, $image_extension); // extract the image extension
                $image = preg_replace('/data:image\/(.*?);base64,/', '', $image); // remove the type part
                $image = str_replace(' ', '+', $image);
                $imageName = 'image_' . time() . '.' . $image_extension[1]; //generating unique file name;

                if ($image != "") { // storing image in storage/app/public Folder
                    Storage::disk('public')->put($imageName, base64_decode($image));
                }

                $mission->image_file = $imageName;
            }

            $mission->save();

            \DB::commit();

            return response(['success' => true]);
        } catch (Throwable $th) {
            \DB::rollBack();
            if ($th instanceof AuthorizationException) {
                throw $th;
            }
            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    public function show(int $id)
    {

        $mission = Mission::where('id', $id)->where('is_public', 1)->where('is_approved', 1)->with(['user', 'group'])->first();

        if (empty($mission)) {
            return response()->json(['error' => 'Registro não encontrado']);
        }

        $mission->missao = $mission->getName();
        $linkShare = urlencode('https://desafio2020.criativosdaescola.com.br/mural-chama/missao?code=' . $id);
        $nameShare = urlencode($mission->getName() . ': curta minha produção no Desafio Criativos da Escola 2020');
        $mission->curtir_btn = '<svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg"> <g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)"> <path d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z" id="heart" fill="transparent" stroke="#EC4359" stroke-width="2px" /> <circle id="main-circ" fill="#E2264D" opacity="0" cx="29.5" cy="29.5" r="1.5"/> <g id="grp7" opacity="0" transform="translate(7 6)"> <circle id="oval1" fill="#9CD8C3" cx="2" cy="6" r="2"/> <circle id="oval2" fill="#8CE8C3" cx="5" cy="2" r="2"/> </g> <g id="grp6" opacity="0" transform="translate(0 28)"> <circle id="oval1" fill="#CC8EF5" cx="2" cy="7" r="2"/> <circle id="oval2" fill="#91D2FA" cx="3" cy="2" r="2"/> </g> <g id="grp3" opacity="0" transform="translate(52 28)"> <circle id="oval2" fill="#9CD8C3" cx="2" cy="7" r="2"/> <circle id="oval1" fill="#8CE8C3" cx="4" cy="2" r="2"/> </g> <g id="grp2" opacity="0" transform="translate(44 6)"> <circle id="oval2" fill="#CC8EF5" cx="5" cy="6" r="2"/> <circle id="oval1" fill="#CC8EF5" cx="2" cy="2" r="2"/> </g> <g id="grp5" opacity="0" transform="translate(14 50)"> <circle id="oval1" fill="#91D2FA" cx="6" cy="5" r="2"/> <circle id="oval2" fill="#91D2FA" cx="2" cy="2" r="2"/> </g> <g id="grp4" opacity="0" transform="translate(35 50)"> <circle id="oval1" fill="#F48EA7" cx="6" cy="5" r="2"/> <circle id="oval2" fill="#F48EA7" cx="2" cy="2" r="2"/> </g> <g id="grp1" opacity="0" transform="translate(24)"> <circle id="oval1" fill="#9FC7FA" cx="2.5" cy="3" r="2"/> <circle id="oval2" fill="#9FC7FA" cx="7.5" cy="2" r="2"/> </g> </g> </svg>';
        $mission->compartilhar = '<div class="addtoany_shortcode"><div class="a2a_kit a2a_kit_size_30 addtoany_list" data-a2a-url="' . $linkShare . '" data-a2a-title="' . $mission->getName() . ': curta minha produção no Desafio Criativos da Escola 2020" style="line-height: 30px;"><a class="a2a_button_facebook" href="/#facebook" title="Facebook" rel="nofollow noopener" target="_blank"><span class="a2a_svg a2a_s__default a2a_s_facebook" style="background-color: transparent; width: 30px; line-height: 30px; height: 30px; background-size: 30px; border-radius: 4px;"><svg focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#55c7df" d="M17.78 27.5V17.008h3.522l.527-4.09h-4.05v-2.61c0-1.182.33-1.99 2.023-1.99h2.166V4.66c-.375-.05-1.66-.16-3.155-.16-3.123 0-5.26 1.905-5.26 5.405v3.016h-3.53v4.09h3.53V27.5h4.223z"></path></svg></span><span class="a2a_label">Facebook</span></a><a class="a2a_button_twitter" href="http://www.addtoany.com/add_to/twitter?linkurl=' . $linkShare . ';linkname=' . $nameShare . ';linknote=" title="Twitter" rel="nofollow noopener" target="_blank"><span class="a2a_svg a2a_s__default a2a_s_twitter" style="background-color: transparent; width: 30px; line-height: 30px; height: 30px; background-size: 30px; border-radius: 4px;"><svg focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#55c7df" d="M28 8.557a9.913 9.913 0 0 1-2.828.775 4.93 4.93 0 0 0 2.166-2.725 9.738 9.738 0 0 1-3.13 1.194 4.92 4.92 0 0 0-3.593-1.55 4.924 4.924 0 0 0-4.794 6.049c-4.09-.21-7.72-2.17-10.15-5.15a4.942 4.942 0 0 0-.665 2.477c0 1.71.87 3.214 2.19 4.1a4.968 4.968 0 0 1-2.23-.616v.06c0 2.39 1.7 4.38 3.952 4.83-.414.115-.85.174-1.297.174-.318 0-.626-.03-.928-.086a4.935 4.935 0 0 0 4.6 3.42 9.893 9.893 0 0 1-6.114 2.107c-.398 0-.79-.023-1.175-.068a13.953 13.953 0 0 0 7.55 2.213c9.056 0 14.01-7.507 14.01-14.013 0-.213-.005-.426-.015-.637.96-.695 1.795-1.56 2.455-2.55z"></path></svg></span><span class="a2a_label">Twitter</span></a><a class="a2a_button_whatsapp" href="/#whatsapp" title="WhatsApp" rel="nofollow noopener" target="_blank"><span class="a2a_svg a2a_s__default a2a_s_whatsapp" style="background-color: transparent; width: 30px; line-height: 30px; height: 30px; background-size: 30px; border-radius: 4px;"><svg focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill-rule="evenodd" clip-rule="evenodd" fill="#55c7df" d="M16.21 4.41C9.973 4.41 4.917 9.465 4.917 15.7c0 2.134.592 4.13 1.62 5.832L4.5 27.59l6.25-2.002a11.241 11.241 0 0 0 5.46 1.404c6.234 0 11.29-5.055 11.29-11.29 0-6.237-5.056-11.292-11.29-11.292zm0 20.69c-1.91 0-3.69-.57-5.173-1.553l-3.61 1.156 1.173-3.49a9.345 9.345 0 0 1-1.79-5.512c0-5.18 4.217-9.4 9.4-9.4 5.183 0 9.397 4.22 9.397 9.4 0 5.188-4.214 9.4-9.398 9.4zm5.293-6.832c-.284-.155-1.673-.906-1.934-1.012-.265-.106-.455-.16-.658.12s-.78.91-.954 1.096c-.176.186-.345.203-.628.048-.282-.154-1.2-.494-2.264-1.517-.83-.795-1.373-1.76-1.53-2.055-.158-.295 0-.445.15-.584.134-.124.3-.326.45-.488.15-.163.203-.28.306-.47.104-.19.06-.36-.005-.506-.066-.147-.59-1.587-.81-2.173-.218-.586-.46-.498-.63-.505-.168-.007-.358-.038-.55-.045-.19-.007-.51.054-.78.332-.277.274-1.05.943-1.1 2.362-.055 1.418.926 2.826 1.064 3.023.137.2 1.874 3.272 4.76 4.537 2.888 1.264 2.9.878 3.43.85.53-.027 1.734-.633 2-1.297.266-.664.287-1.24.22-1.363-.07-.123-.26-.203-.54-.357z"></path></svg></span><span class="a2a_label">WhatsApp</span></a></div></div>';

        return response()->json($mission);

    }

    public function update(int $id, Request $request)
    {
        try {

            \DB::beginTransaction();

            $payload = $request->all();
            $group = $this->groupsService->update($id, $payload);

            \DB::commit();

            return response()->json($group);
        } catch (Throwable $th) {

            \DB::rollBack();

            if ($th instanceof AuthorizationException) {
                throw $th;
            }

            return response()->json(['message' => $th->getMessage()], 400);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->groupsService->delete($id);

            return response()->json('', 204);
        } catch (Throwable $th) {
            if ($th instanceof AuthorizationException) {
                throw $th;
            }

            return response()->json(['message' => $th->getMessage()], 400);
        }
    }
}
