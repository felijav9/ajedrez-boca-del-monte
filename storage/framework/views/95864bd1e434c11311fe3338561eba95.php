<?php if (isset($component)) { $__componentOriginal02f4f3f1f697f2a01e668afcebdac906 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal02f4f3f1f697f2a01e668afcebdac906 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'f4ac99e09542ff494432bc959d4fee61::app-plantilla','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts::app-plantilla'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('sistema.protejo-mi-mente.jugadores-protejo', []);

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2852363369-0', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal02f4f3f1f697f2a01e668afcebdac906)): ?>
<?php $attributes = $__attributesOriginal02f4f3f1f697f2a01e668afcebdac906; ?>
<?php unset($__attributesOriginal02f4f3f1f697f2a01e668afcebdac906); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal02f4f3f1f697f2a01e668afcebdac906)): ?>
<?php $component = $__componentOriginal02f4f3f1f697f2a01e668afcebdac906; ?>
<?php unset($__componentOriginal02f4f3f1f697f2a01e668afcebdac906); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\Sistema\resources\views/sistema/protejo-mi-mente/jugadores-protejo.blade.php ENDPATH**/ ?>